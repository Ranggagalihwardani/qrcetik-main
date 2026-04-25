<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'regular_users' => User::where('role', 'user')->count(),

            // 🔥 FIX ERROR UTAMA
            'new_this_month' => User::whereMonth('created_at', Carbon::now()->month)
                                    ->whereYear('created_at', Carbon::now()->year)
                                    ->count(),

            // OPTIONAL (biar chart tidak error)
            'monthly_labels' => ['Jan','Feb','Mar','Apr','Mei','Jun'],
            'monthly_registrations' => [0,0,0,0,0,0],
        ];

        return view('admin.dashboard', compact('stats'));
    }
}