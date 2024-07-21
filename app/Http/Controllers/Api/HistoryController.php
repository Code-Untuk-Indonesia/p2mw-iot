<?php

namespace App\Http\Controllers\Api;

use App\Models\History;
use App\Models\UserApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    public function history($userAppId)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userApp = UserApp::where('UniqueID', $userAppId)->first();

        if (!$userApp) {
            return response()->json(['message' => 'UserApp not found or not authorized'], 404);
        }

        $histories = History::whereHas('alat', function ($query) use ($userApp) {
            $query->where('userapps_id', $userApp->UniqueID);
        })->with('alat')->get();

        $formattedHistories = $histories->map(function ($history) {
            return [
                'id' => $history->id,
                'kejadian' => $history->kejadian,
                'lokasi' => $history->long . ', ' . $history->lat,
                'created_at' => $history->created_at,
            ];
        });

        return response()->json([
            'user' => [
                'id' => $userApp->UniqueID,
                'name' => $userApp->name,
                'email' => $userApp->email,
                'profile_picture' => $userApp->profile_picture,
                'created_at' => $userApp->created_at,
                'updated_at' => $userApp->updated_at,
            ],
            'histories' => $formattedHistories
        ], 200);
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

        $history = History::create([
            'id_alat' => $alat->id,
            'long' => $request->long,
            'lat' => $request->lat,
            'kejadian' => $request->kejadian,
        ]);

        return response()->json(['message' => 'History created successfully', 'data' => $history], 201);
    }
}
