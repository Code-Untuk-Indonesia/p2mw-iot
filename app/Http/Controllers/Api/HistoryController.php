<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserApp;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function history()
    {
        // Get the authenticated user
        $user = Auth::guard('api')->user();

        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Fetch histories for the authenticated user
        $histories = History::whereHas('alat', function ($query) use ($user) {
            $query->where('userapps_id', $user->UniqueID);
        })->with('alat', 'lokasi')->get();

        return response()->json([
            'user' => $user,
            'histories' => $histories
        ], 200);
    }
}
