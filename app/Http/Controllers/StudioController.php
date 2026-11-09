<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Support\Facades\DB;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::all();

        return view('studios.index', compact('studios'));
    }

    public function show($studio_id)
    {
        $studio = Studio::findOrFail($studio_id);

        // Ambil semua foto milik studio dari tabel studio_images
        $studioImages = DB::table('studio_images')
            ->where('studio_id', $studio_id)
            ->orderBy('studio_image_id', 'asc')
            ->get();

        return view('studios.show', compact('studio', 'studioImages'));
    }
}
