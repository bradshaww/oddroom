<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CancelExpiredBookings extends Command
{
    protected $signature = 'bookings:cancel-expired';

    protected $description = 'Cancel bookings that exceed their payment or verification deadline';

    public function handle(): int
    {
        $now = now();

        // 1. Batalkan booking yang belum dibayar dalam 30 menit.
        $expiredPayments = DB::table('bookings')
            ->where('status', 'pending_payment')
            ->where('created_at', '<=', $now->copy()->subMinutes(30))
            ->update([
                'status' => 'cancelled',
                'updated_at' => $now,
            ]);

        // 2. Batalkan booking yang belum diputuskan admin
        // dalam 30 menit sejak bukti pembayaran dikirim.
        $expiredVerifications = DB::table('bookings')
            ->join(
                'payments',
                'bookings.booking_id',
                '=',
                'payments.booking_id'
            )
            ->where('bookings.status', 'pending_verification')
            ->where('payments.status', 'waiting')
            ->whereNotNull('payments.created_at')
            ->where(
                'payments.created_at',
                '<=',
                $now->copy()->subMinutes(30)
            )
            ->update([
                'bookings.status' => 'cancelled',
                'bookings.updated_at' => $now,
            ]);

        $this->info("Booking belum dibayar yang dibatalkan: {$expiredPayments}");
        $this->info("Booking menunggu verifikasi yang dibatalkan: {$expiredVerifications}");

        return self::SUCCESS;
    }
}
