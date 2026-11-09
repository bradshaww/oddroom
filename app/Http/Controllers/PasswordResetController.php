<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $resetUrl = null;

        $status = Password::sendResetLink(
            $request->only('email'),
            function (User $user, string $token) use (&$resetUrl) {

                $resetUrl = route('password.reset', [
                    'token' => $token,
                    'email' => $user->getEmailForPasswordReset(),
                ]);

                $user->sendPasswordResetNotification($token);

                return Password::RESET_LINK_SENT;
            }
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with([
                'success' => 'Your password reset link is ready. Click below to continue.',
                'reset_url' => $resetUrl,
            ]);
        }

        if ($status === Password::RESET_THROTTLED) {
            return back()->withErrors([
                'email' => 'Please wait before requesting another reset link.',
            ]);
        }

        return back()->withErrors([
            'email' => 'We could not find an account with that email address.',
        ]);
    }

    public function showResetForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password,
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect('/login')->with(
                'success',
                'Password reset successfully. Please log in with your new password.'
            );
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}
