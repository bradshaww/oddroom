<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalStudios = DB::table('studios')->count();

        $totalBookings = DB::table('bookings')->count();

        $pendingBookings = DB::table('bookings')
            ->where('status', 'pending_verification')
            ->count();

        $pendingPayments = DB::table('payments')
            ->where('status', 'waiting')
            ->count();

        return view('admin.dashboard', compact(
            'totalStudios',
            'totalBookings',
            'pendingBookings',
            'pendingPayments'
        ));
    }
}
