<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserApp;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_apps',
            'password' => 'required|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = time() . '_' . $profilePicture->getClientOriginalExtension();
            $profilePicturePath = public_path('profile_pictures');
            $profilePicture->move($profilePicturePath, $profilePictureName);
        }

        $user = UserApp::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $profilePictureName,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->UniqueID,
                'name' => $user->name,
                'email' => $user->email,
                'profile_picture' => $user->profile_picture,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('api')->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::guard('api')->user();
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->UniqueID,
                'name' => $user->name,
                'email' => $user->email,
                'profile_picture' => $user->profile_picture,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
        ], 200);
    }

    // Logout
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => 'Failed to logout, please try again'], 500);
        }
    }


    // Update
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_apps,email,' . Auth::guard('api')->user()->id,
            'password' => 'required|string|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::guard('api')->user();
        $profilePicturePath = $user->profile_picture; // Default to existing path

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = time() . '_' . $profilePicture->getClientOriginalExtension();
            $profilePicturePath = public_path('profile_pictures');
            $profilePicture->move($profilePicturePath, $profilePictureName);
            $profilePicturePath = $profilePictureName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_picture = $profilePicturePath;
        $user->save();

        return response()->json(['message' => 'Successfully updated!'], 200);
    }

    // Refresh token
    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json([
                'access_token' => $newToken,
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => 'Token invalid'], 401);
        }
    }
}
