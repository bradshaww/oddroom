<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdminSlotController extends Controller
{
    // Menampilkan slot berdasarkan studio.
    public function index($studio_id)
    {
        $studio = DB::table('studios')
            ->where('studio_id', $studio_id)
            ->first();

        abort_if(!$studio, 404);

        $slots = DB::table('studio_slots')
            ->where('studio_id', $studio_id)
            ->orderBy('start_time')
            ->get();

        return view('admin.studios.slots', compact(
            'studio',
            'slots'
        ));
    }

    // Menambahkan slot baru.
    public function store(Request $request, $studio_id)
    {
        $studio = DB::table('studios')
            ->where('studio_id', $studio_id)
            ->first();

        abort_if(!$studio, 404);

        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $overlap = DB::table('studio_slots')
            ->where('studio_id', $studio_id)
            ->where('start_time', '<', $validated['end_time'])
            ->where('end_time', '>', $validated['start_time'])
            ->exists();

        if ($overlap) {
            throw ValidationException::withMessages([
                'start_time' => 'Jam tersebut bertabrakan dengan slot yang sudah ada.',
            ]);
        }

        DB::table('studio_slots')->insert([
            'studio_id' => $studio_id,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return redirect("/admin/studios/{$studio_id}/slots")
            ->with('success', 'Slot berhasil ditambahkan!');
    }

    // Mengubah slot.
    public function update(Request $request, $studio_id, $slot_id)
    {
        $slot = DB::table('studio_slots')
            ->where('slot_id', $slot_id)
            ->where('studio_id', $studio_id)
            ->first();

        abort_if(!$slot, 404);

        $isBooked = DB::table('booking_slots')
            ->where('slot_id', $slot_id)
            ->exists();

        if ($isBooked) {
            return back()->with(
                'error',
                'Slot tidak bisa diubah karena sudah digunakan dalam riwayat booking.'
            );
        }

        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $overlap = DB::table('studio_slots')
            ->where('studio_id', $studio_id)
            ->where('slot_id', '!=', $slot_id)
            ->where('start_time', '<', $validated['end_time'])
            ->where('end_time', '>', $validated['start_time'])
            ->exists();

        if ($overlap) {
            throw ValidationException::withMessages([
                'start_time' => 'Jam tersebut bertabrakan dengan slot yang sudah ada.',
            ]);
        }

        DB::table('studio_slots')
            ->where('slot_id', $slot_id)
            ->update([
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);

        return back()->with('success', 'Slot berhasil diperbarui!');
    }

    // Menghapus slot.
    public function destroy($studio_id, $slot_id)
    {
        $slot = DB::table('studio_slots')
            ->where('slot_id', $slot_id)
            ->where('studio_id', $studio_id)
            ->first();

        abort_if(!$slot, 404);

        $isBooked = DB::table('booking_slots')
            ->where('slot_id', $slot_id)
            ->exists();

        if ($isBooked) {
            return back()->with(
                'error',
                'Slot tidak bisa dihapus karena sudah digunakan dalam riwayat booking.'
            );
        }

        DB::table('studio_slots')
            ->where('slot_id', $slot_id)
            ->delete();

        return back()->with('success', 'Slot berhasil dihapus!');
    }
}
