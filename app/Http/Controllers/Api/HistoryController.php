<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserApp;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

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
}
