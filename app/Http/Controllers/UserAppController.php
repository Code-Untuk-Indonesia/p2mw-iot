<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\UserApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserAppController extends Controller
{
    public function index()
    {
        $users = UserApp::all();
        return view('admin.user-management', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        Log::info('Request data:', $request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user_apps',
            'password' => 'required|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        // Inisialisasi variabel untuk menyimpan path gambar
        $gambarPath = null;

        // Generate kode_alat secara otomatis
        // $generatedCode = 'ALAT_' . uniqid();

        if ($request->hasFile('profile_picture')) {
            // Simpan gambar di storage publik dan dapatkan path relatifnya
            $gambarPath = $request->file('profile_picture')->store('images/profile_picture', 'public');
        }

        // Buat user baru dan simpan data termasuk path gambar
        $userApp = UserApp::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $gambarPath,

        ]);
        Log::info('User created:', $userApp->toArray());
        return redirect()->route('userapp.index')->with('success', 'User created successfully.');
    }

    public function history(UserApp $userApp)
    {
        $histories = History::whereHas('alat', function ($query) use ($userApp) {
            $query->where('userapps_id', $userApp->UniqueID);
        })->with('alat', 'lokasi')->get();
        return view('admin.user-history', compact('userApp', 'histories'));
    }
}
