<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserApp;
use App\Models\Realtime;
use Illuminate\Support\Facades\Auth;

class RealtimeController extends Controller
{
    public function index(UserApp $userApp)
    {
        $realtimes = Realtime::whereHas('alat', function ($query) use ($userApp) {
            $query->where('userapps_id', $userApp->UniqueID);
        })->with('alat')->get();

        return response()->json($realtimes, 200);
    }
}
