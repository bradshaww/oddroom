<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyBookingController extends Controller
{
    public function index()
    {
        // Ambil booking milik customer yang sedang login
        $bookings = DB::table('bookings')
            ->join(
                'studios',
                'bookings.studio_id',
                '=',
                'studios.studio_id'
            )
            ->leftJoin(
                'payments',
                'bookings.booking_id',
                '=',
                'payments.booking_id'
            )
            ->where('bookings.user_id', Auth::id())
            ->select(
                'bookings.booking_id',
                'bookings.booking_date',
                'bookings.status',
                'studios.name as studio_name',
                'studios.price_per_hour',
                'payments.status as payment_status'
            )
            ->orderByDesc('bookings.created_at')
            ->get();

        // Ambil slot waktu dan hitung harga setiap booking
        foreach ($bookings as $booking) {
            $booking->slots = DB::table('booking_slots')
                ->join(
                    'studio_slots',
                    'booking_slots.slot_id',
                    '=',
                    'studio_slots.slot_id'
                )
                ->where(
                    'booking_slots.booking_id',
                    $booking->booking_id
                )
                ->orderBy('studio_slots.start_time')
                ->get();

            $booking->total = $booking->price_per_hour
                * $booking->slots->count();
        }

        return view('my-bookings.index', compact('bookings'));
    }
}
