<?php

namespace App\Http\Controllers;

use App\Models\UserApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Inisialisasi variabel untuk menyimpan path gambar
        $gambarPath = null;

        if ($request->hasFile('profile_picture')) {
            // Simpan gambar di storage publik dan dapatkan path relatifnya
            $gambarPath = $request->file('profile_picture')->store('images/profile_picture', 'public');
        }

        // Buat user baru dan simpan data termasuk path gambar
        UserApp::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $gambarPath
        ]);

        return redirect()->route('userapp.index')->with('success', 'User created successfully.');
    }

}
