<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\UserApp;
use Illuminate\Support\Str;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('userApp')->get();
        return view('admin.alats.index', compact('alats'));
    }

    public function create()
    {
        $users = UserApp::all();
        return view('admin.alats.create', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'userapps_id' => 'required|exists:user_apps,UniqueID',
        ]);

        $kodealat = 'kodealat_' . Str::random(10);

        Alat::create([
            'kode_alat' => $kodealat,
            'userapps_id' => $request->userapps_id,
            'kejadian' => '',
        ]);

        return redirect()->route('alats.index')->with('success', 'Alat created successfully.');
    }
}
