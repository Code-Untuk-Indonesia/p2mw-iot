<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Realtime;
use Illuminate\Support\Facades\Auth;

class RealtimeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $realtimes = Realtime::whereHas('alat', function ($query) use ($user) {
            $query->where('userapps_id', $user->UniqueID);
        })->get();

        $realtimeData = $realtimes->map(function ($realtime) {
            return [
                'id' => $realtime->id,
                'alat_id' => $realtime->alat_id,
                'lat' => $realtime->lat,
                'long' => $realtime->long,
                'created_at' => $realtime->created_at,
                'updated_at' => $realtime->updated_at,
            ];
        });

        return response()->json($realtimeData, 200);
    }
}
