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

        // $path = $request->file('profile_picture') ? $request->file('profile_picture')->store('profile_pictures', 'public') : null;

        if ($request->hasFile('profile_picture')) {
            $gambar = $request->file('profile_picture');
            $profilPic = time() . '_profile_picture.' . $gambar->getClientOriginalExtension();
            $gambarPath = public_path('images/profile_picture');
            $gambar->move($gambarPath, $profilPic);
        }

        UserApp::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $gambar
        ]);

        return redirect()->route('userapp.index')->with('success', 'User created successfully.');
    }
}
