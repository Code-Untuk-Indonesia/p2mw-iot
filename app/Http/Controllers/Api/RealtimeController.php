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
        })->with(['alat', 'lokasi'])->get();

        $realtimeData = $realtimes->map(function ($realtime) {
            return [
                'id' => $realtime->id,
                'alat_id' => $realtime->alat_id,
                'lokasi_id' => $realtime->lokasi_id,
                'alat' => [
                    'id' => $realtime->alat->id,
                    'kodealat' => $realtime->alat->kodealat,
                    'kejadian' => $realtime->alat->kejadian,
                    'userapps_id' => $realtime->alat->userapps_id,
                ],
                'lokasi' => [
                    'id' => $realtime->lokasi->id,
                    'lat' => $realtime->lokasi->lat,
                    'long' => $realtime->lokasi->long,
                ],
                'created_at' => $realtime->created_at,
                'updated_at' => $realtime->updated_at,
            ];
        });

        return response()->json($realtimeData, 200);
    }
}
