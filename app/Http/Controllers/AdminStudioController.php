<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminStudioController extends Controller
{
    // Menampilkan semua studio
    public function index()
    {
        $studios = DB::table('studios')
            ->orderBy('studio_id')
            ->get();

        return view('admin.studios.index', compact('studios'));
    }

    // Menampilkan form tambah studio
    public function create()
    {
        return view('admin.studios.create');
    }

    // Menyimpan studio baru beserta beberapa foto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $studioId = DB::table('studios')->insertGetId([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => null,
            'price_per_hour' => $validated['price_per_hour'],
            'created_at' => now(),
            'updated_at' => now(),
        ], 'studio_id');

        $firstImage = null;

        foreach ($request->file('images') as $file) {
            $filename = uniqid('studio_') . '.' . $file->extension();

            $file->move(public_path('images'), $filename);

            DB::table('studio_images')->insert([
                'studio_id' => $studioId,
                'image_path' => $filename,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($firstImage === null) {
                $firstImage = $filename;
            }
        }

        DB::table('studios')
            ->where('studio_id', $studioId)
            ->update(['image' => $firstImage]);

        return redirect('/admin/studios')
            ->with('success', 'Studio berhasil ditambahkan!');
    }

    //form edit studio
    public function edit($studio_id)
    {
        $studio = DB::table('studios')
            ->where('studio_id', $studio_id)
            ->first();

        abort_if(!$studio, 404);

        // pindah gambar lama ke daftar studio_images
        if ($studio->image) {
            $hasImages = DB::table('studio_images')
                ->where('studio_id', $studio_id)
                ->exists();

            if (!$hasImages) {
                DB::table('studio_images')->insert([
                    'studio_id' => $studio_id,
                    'image_path' => $studio->image,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $studioImages = DB::table('studio_images')
            ->where('studio_id', $studio_id)
            ->orderBy('studio_image_id')
            ->get();

        return view('admin.studios.edit', compact('studio', 'studioImages'));
    }

    // Menyimpan perubahan studio dan foto
    public function update(Request $request, $studio_id)
    {
        $studio = DB::table('studios')
            ->where('studio_id', $studio_id)
            ->first();

        abort_if(!$studio, 404);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer',
        ]);

        // Menghapus foto yang dipilih admin
        foreach ($request->input('delete_images', []) as $imageId) {
            $image = DB::table('studio_images')
                ->where('studio_image_id', $imageId)
                ->where('studio_id', $studio_id)
                ->first();

            if ($image) {
                $path = public_path('images/' . $image->image_path);

                if (File::exists($path)) {
                    File::delete($path);
                }

                DB::table('studio_images')
                    ->where('studio_image_id', $imageId)
                    ->delete();
            }
        }

        // Menambahkan foto baru
        foreach ($request->file('images', []) as $file) {
            $filename = uniqid('studio_') . '.' . $file->extension();

            $file->move(public_path('images'), $filename);

            DB::table('studio_images')->insert([
                'studio_id' => $studio_id,
                'image_path' => $filename,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Mengambil foto pertama yang masih tersimpan
        $firstImage = DB::table('studio_images')
            ->where('studio_id', $studio_id)
            ->orderBy('studio_image_id')
            ->value('image_path');

        DB::table('studios')
            ->where('studio_id', $studio_id)
            ->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'image' => $firstImage,
                'price_per_hour' => $validated['price_per_hour'],
                'updated_at' => now(),
            ]);

        return redirect('/admin/studios')
            ->with('success', 'Studio berhasil diperbarui!');
    }

    // Menghapus studio
    public function destroy($studio_id)
    {
        $studio = DB::table('studios')
            ->where('studio_id', $studio_id)
            ->first();

        abort_if(!$studio, 404);

        // Studio yang sudah memiliki booking tidak boleh dihapus.
        $hasBookings = DB::table('bookings')
            ->where('studio_id', $studio_id)
            ->exists();

        if ($hasBookings) {
            return redirect('/admin/studios')
                ->with('error', 'Studio tidak bisa dihapus karena sudah memiliki booking.');
        }

        $images = DB::table('studio_images')
            ->where('studio_id', $studio_id)
            ->get();

        foreach ($images as $image) {
            $path = public_path('images/' . $image->image_path);

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        DB::table('studio_images')
            ->where('studio_id', $studio_id)
            ->delete();

        DB::table('studio_slots')
            ->where('studio_id', $studio_id)
            ->delete();

        DB::table('studios')
            ->where('studio_id', $studio_id)
            ->delete();

        return redirect('/admin/studios')
            ->with('success', 'Studio berhasil dihapus!');
    }
}
