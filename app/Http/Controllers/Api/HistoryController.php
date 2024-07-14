<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserApp;
use App\Models\History;

class HistoryController extends Controller
{
    public function history(UserApp $userApp)
    {
        $histories = History::whereHas('alat', function ($query) use ($userApp) {
            $query->where('userapps_id', $userApp->UniqueID);
        })->with('alat', 'lokasi')->get();

        return response()->json([
            'user' => $userApp,
            'histories' => $histories
        ]);
    }
}
