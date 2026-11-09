<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $studio = Studio::findOrFail($request->query('studio_id'));

        $slots = DB::table('studio_slots')
            ->where('studio_id', $studio->studio_id)
            ->orderBy('start_time')
            ->get();

        // Ambil slot yang sudah dipesan untuk bulan berjalan.
        // Booking yang belum dibatalkan atau ditolak tetap mengunci slot.
        $bookings = DB::table('booking_slots')
            ->join(
                'bookings',
                'booking_slots.booking_id',
                '=',
                'bookings.booking_id'
            )
            ->where('bookings.studio_id', $studio->studio_id)
            ->whereBetween('bookings.booking_date', [
                now()->startOfMonth()->toDateString(),
                now()->endOfMonth()->toDateString(),
            ])
            ->whereNotIn('bookings.status', [
                'cancelled',
                'rejected',
            ])
            ->select(
                'bookings.booking_date',
                'booking_slots.slot_id'
            )
            ->get();

        // Format: tanggal => daftar ID slot yang sudah terisi.
        $bookedSlotsByDate = [];

        foreach ($bookings as $booking) {
            $date = $booking->booking_date;

            $bookedSlotsByDate[$date][] = (int) $booking->slot_id;
        }

        return view('booking.create', compact(
            'studio',
            'slots',
            'bookedSlotsByDate'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'studio_id' => 'required|integer|exists:studios,studio_id',
            'booking_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:' . now()->toDateString(),
                'before_or_equal:' . now()->endOfMonth()->toDateString(),
            ],
            'time_slots' => 'required|array|min:1',
            'time_slots.*' => 'required|integer|distinct',
        ]);

        $studio = Studio::findOrFail($validated['studio_id']);

        $slotIds = array_map(
            'intval',
            $validated['time_slots']
        );

        // Pastikan semua slot benar-benar milik studio ini.
        $validSlots = DB::table('studio_slots')
            ->where('studio_id', $studio->studio_id)
            ->whereIn('slot_id', $slotIds)
            ->orderBy('start_time')
            ->get();

        if ($validSlots->count() !== count($slotIds)) {
            throw ValidationException::withMessages([
                'time_slots' => 'Slot yang dipilih tidak valid.',
            ]);
        }

        // Slot terpilih harus berurutan tanpa jeda waktu.
        for ($i = 1; $i < $validSlots->count(); $i++) {
            $previousSlot = $validSlots[$i - 1];
            $currentSlot = $validSlots[$i];

            if ($previousSlot->end_time !== $currentSlot->start_time) {
                throw ValidationException::withMessages([
                    'time_slots' =>
                        'Pilih slot dengan jam yang berurutan tanpa jeda.',
                ]);
            }
        }

        $bookingId = DB::transaction(function () use (
            $validated,
            $slotIds,
            $studio
        ) {
            // Kunci baris studio untuk mengurangi risiko
            // dua transaksi memesan slot bersamaan.
            DB::table('studios')
                ->where('studio_id', $studio->studio_id)
                ->lockForUpdate()
                ->first();

            // Periksa ulang ketersediaan di dalam transaksi.
            $alreadyBooked = DB::table('booking_slots')
                ->join(
                    'bookings',
                    'booking_slots.booking_id',
                    '=',
                    'bookings.booking_id'
                )
                ->where('bookings.studio_id', $studio->studio_id)
                ->where(
                    'bookings.booking_date',
                    $validated['booking_date']
                )
                ->whereNotIn('bookings.status', [
                    'cancelled',
                    'rejected',
                ])
                ->whereIn('booking_slots.slot_id', $slotIds)
                ->exists();

            if ($alreadyBooked) {
                throw ValidationException::withMessages([
                    'time_slots' =>
                        'Salah satu slot sudah dipesan. Silakan pilih slot lain.',
                ]);
            }

            $bookingId = DB::table('bookings')->insertGetId([
                'user_id' => Auth::id(),
                'studio_id' => $studio->studio_id,
                'booking_date' => $validated['booking_date'],
                'status' => 'pending_payment',
                'created_at' => now(),
                'updated_at' => now(),
            ], 'booking_id');

            foreach ($slotIds as $slotId) {
                DB::table('booking_slots')->insert([
                    'booking_id' => $bookingId,
                    'slot_id' => $slotId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return $bookingId;
        });

        return redirect('/payment/' . $bookingId);
    }
}
