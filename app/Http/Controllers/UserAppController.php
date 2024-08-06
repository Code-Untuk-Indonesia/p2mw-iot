<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\UserApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class UserAppController extends Controller
{
    public function index()
    {
        $users = UserApp::orderBy('created_at', 'desc')->simplePaginate(5);
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

        // Initialize the variable to store the image path
        $gambarPath = null;

        if ($request->hasFile('profile_picture')) {
            // Get the uploaded file
            $file = $request->file('profile_picture');

            // Generate a unique file name and move the file to the public path
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/profile_picture');
            $file->move($destinationPath, $fileName);

            // Set the path relative to the public directory
            $gambarPath = 'images/profile_picture/' . $fileName;
        }

        // Create a new user and save the data including the image path
        $userApp = UserApp::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $gambarPath,
        ]);

        Log::info('User created:', $userApp->toArray());

        return redirect()->route('userapp.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        Log::info('Update request data:', $request->all());

        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user_apps,email,' . $id,
            'password' => 'nullable|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Find the user by ID
        $userApp = UserApp::findOrFail($id);

        // Update the user data
        $userApp->name = $request->name;
        $userApp->email = $request->email;

        // Only update password if it's provided
        if ($request->filled('password')) {
            $userApp->password = Hash::make($request->password);
        }

        // Handle the profile picture update
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($userApp->profile_picture) {
                $oldProfilePicturePath = public_path($userApp->profile_picture);
                if (file_exists($oldProfilePicturePath)) {
                    unlink($oldProfilePicturePath);
                }
            }

            // Get the uploaded file
            $file = $request->file('profile_picture');

            // Generate a unique file name and move the file to the public path
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/profile_picture');
            $file->move($destinationPath, $fileName);

            // Set the path relative to the public directory
            $userApp->profile_picture = 'images/profile_picture/' . $fileName;
        }

        // Save the updated user data
        $userApp->save();

        Log::info('User updated:', $userApp->toArray());

        return redirect()->route('userapp.index')->with('success', 'User updated successfully.');
    }
}
