<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\UserApp;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $users = UserApp::all();
        return view('admin.user-history', compact('users'));
    }

    public function userHistory(Request $request, $userId)
    {
        $user = UserApp::where('UniqueID', $userId)->firstOrFail();

        $histories = History::whereHas('alat', function ($query) use ($user) {
            $query->where('userapps_id', $user->UniqueID);
        })->with('alat')->get();

        return response()->json(['user' => $user, 'histories' => $histories]);
    }
}
