<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use App\Models\Realtime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request, $kodealat)
    {
        $validator = Validator::make($request->all(), [
            'long' => 'required|string',
            'lat' => 'required|string',
            'kejadian' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $alat = Alat::where('kodealat', $kodealat)->first();

        if (!$alat) {
            return response()->json(['message' => 'Alat not found'], 404);
        }

        $realtime = Realtime::where('alat_id', $alat->id)->first();

        if ($realtime) {
            $realtime->update([
                'long' => $request->long,
                'lat' => $request->lat,
                'kejadian' => $request->kejadian,
            ]);
        } else {
            $realtime = Realtime::create([
                'alat_id' => $alat->id,
                'long' => $request->long,
                'lat' => $request->lat,
                'kejadian' => $request->kejadian,
            ]);
        }

        return response()->json(['message' => 'Realtime data processed successfully', 'data' => $realtime], 200);
    }
}
