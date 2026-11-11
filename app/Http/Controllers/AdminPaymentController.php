<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments = DB::table('payments')
            ->join('bookings', 'payments.booking_id', '=', 'bookings.booking_id')
            ->join('users', 'bookings.user_id', '=', 'users.user_id')
            ->join('studios', 'bookings.studio_id', '=', 'studios.studio_id')
            ->select(
                'payments.*',
                'bookings.booking_date',
                'bookings.status as booking_status',
                'users.name as customer_name',
                'studios.name as studio_name'
            )
            ->orderByDesc('payments.created_at')
            ->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function approve($payment_id)
    {
        return $this->processPayment($payment_id, 'approved');
    }

    public function reject($payment_id)
    {
        return $this->processPayment($payment_id, 'rejected');
    }

    private function processPayment($payment_id, $decision)
    {
        $result = DB::transaction(function () use ($payment_id, $decision) {
            $payment = DB::table('payments')
                ->where('payment_id', $payment_id)
                ->lockForUpdate()
                ->first();

            if (!$payment) {
                return 'not_found';
            }

            if ($payment->status !== 'waiting') {
                return 'already_processed';
            }

            $booking = DB::table('bookings')
                ->where('booking_id', $payment->booking_id)
                ->lockForUpdate()
                ->first();

            if (!$booking ||
                $booking->status !== 'pending_verification') {
                return 'invalid_booking';
            }

            DB::table('payments')
                ->where('payment_id', $payment_id)
                ->update([
                    'status' => $decision,
                    'updated_at' => now(),
                ]);

            DB::table('bookings')
                ->where('booking_id', $payment->booking_id)
                ->update([
                    'status' => $decision === 'approved'
                        ? 'confirmed'
                        : 'rejected',
                    'updated_at' => now(),
                ]);

            return 'success';
        });

        if ($result === 'not_found') {
            abort(404);
        }

        if ($result === 'already_processed') {
            return redirect('/admin/payments')
                ->with('error', 'Pembayaran ini sudah diproses sebelumnya.');
        }

        if ($result === 'invalid_booking') {
            return redirect('/admin/payments')
                ->with('error', 'Status booking tidak sesuai untuk verifikasi.');
        }

        $message = $decision === 'approved'
            ? 'Pembayaran berhasil disetujui!'
            : 'Pembayaran berhasil ditolak.';

        return redirect('/admin/payments')->with('success', $message);
    }
}
