<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\UserApp;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $users = UserApp::all();
        $selectedUser = null;
        $histories = [];

        if ($request->has('userSelect')) {
            $selectedUser = UserApp::find($request->input('userSelect'));
            if ($selectedUser) {
                $histories = History::whereHas('alat', function ($query) use ($selectedUser) {
                    $query->where('userapps_id', $selectedUser->UniqueID);
                })->with('alat')->orderBy('created_at', 'desc')->get();
            }
        }

        return view('admin.user-history', compact('users', 'selectedUser', 'histories'));
    }
}
