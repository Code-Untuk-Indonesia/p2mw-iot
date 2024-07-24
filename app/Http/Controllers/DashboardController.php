<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Realtime;
use App\Models\UserApp;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = UserApp::count();
        $totalProducts = Alat::count();
        $realtimeData = Realtime::with('alat')->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'realtimeData' => $realtimeData
        ]);
    }

    public function getRealtimeData()
    {
        $realtimeData = Realtime::with('alat')->get();
        return response()->json($realtimeData);
    }
}
