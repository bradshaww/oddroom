<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function create($booking_id)
    {
        // Ambil booking milik customer yang sedang login
        $booking = DB::table('bookings')
            ->join('studios', 'bookings.studio_id', '=', 'studios.studio_id')
            ->where('bookings.booking_id', $booking_id)
            ->where('bookings.user_id', Auth::id())
            ->select('bookings.*', 'studios.name as studio_name',
                'studios.price_per_hour')
            ->first();

        if (!$booking) {
            abort(404);
        }

        // Ambil slot waktu yang dipilih customer
        $slots = DB::table('booking_slots')
            ->join('studio_slots', 'booking_slots.slot_id', '=', 'studio_slots.slot_id')
            ->where('booking_slots.booking_id', $booking_id)
            ->orderBy('studio_slots.start_time')
            ->get();

        // Total harga = harga per jam x jumlah slot
        $total = $booking->price_per_hour * $slots->count();

        return view('payment.create', compact('booking', 'slots', 'total'));
    }

    public function store(Request $request, $booking_id)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:bank_transfer,e_wallet',
            'payment_proof' => 'required|image|max:2048',
        ]);

        // Pastikan booking benar-benar milik customer yang login
        $booking = DB::table('bookings')
            ->where('booking_id', $booking_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$booking || $booking->status !== 'pending_payment') {
            abort(404);
        }

        // Simpan bukti pembayaran ke storage
        $proofPath = $request->file('payment_proof')
            ->store('payment-proofs', 'public');

        // Simpan informasi pembayaran ke database
        DB::table('payments')->insert([
            'booking_id' => $booking_id,
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'status' => 'waiting',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Booking menunggu pemeriksaan admin
        DB::table('bookings')
            ->where('booking_id', $booking_id)
            ->update([
                'status' => 'pending_verification',
                'updated_at' => now(),
            ]);

        return redirect('/studios')->with(
            'success',
            'Payment proof submitted! Please wait for admin verification.'
        );
    }
}
