<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\UserApp;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = UserApp::count();
        $totalProducts = Alat::count(); // Menggunakan contoh Alat, sesuaikan dengan model yang benar

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
        ]);
    }
}
