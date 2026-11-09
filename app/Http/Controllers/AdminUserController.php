<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Pencarian berdasarkan nama, email, atau nomor telepon
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_telp', 'like', "%{$search}%");
            });
        }

        // Filter role pengguna
        if ($request->filled('role') &&
            in_array($request->role, ['admin', 'customer'])) {
            $query->where('role', $request->role);
        }

        $users = $query->orderByDesc('user_id')
            ->paginate(10)
            ->withQueryString();

        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalCustomers = User::where('role', 'customer')->count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalAdmins',
            'totalCustomers'
        ));
    }

    public function destroy($user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();

        // Admin tidak boleh menghapus akunnya sendiri
        if ($user->user_id == auth()->id()) {
            return redirect('/admin/users')
                ->with('error', 'Kamu tidak bisa menghapus akun sendiri.');
        }

        // Cegah penghapusan akun admin lain dari halaman ini
        if ($user->role === 'admin') {
            return redirect('/admin/users')
                ->with('error', 'Akun admin tidak bisa dihapus dari User Control.');
        }

        $user->delete();

        return redirect('/admin/users')
            ->with('success', 'Akun customer berhasil dihapus.');
    }
}
