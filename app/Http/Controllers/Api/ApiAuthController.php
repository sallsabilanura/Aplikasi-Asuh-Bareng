<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Helpers\ActivityLogger;

class ApiAuthController extends Controller
{
    /**
     * Login User and return Token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Kredensial yang diberikan salah.'],
            ]);
        }

        // Optional check for approval
        if ($user->role === 'pending' || !$user->is_approved) {
             return response()->json([
                 'message' => 'Akun Anda belum disetujui atau masih pending.',
             ], 403);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        ActivityLogger::log('API Login', "User berhasil login via API (Device: {$request->device_name})", $user->id);

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
            ]
        ]);
    }

    /**
     * Logout User (Revoke Token)
     */
    public function logout(Request $request)
    {
        ActivityLogger::log('API Logout', 'User logout dari API.');
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil logout dan token dicabut.'
        ]);
    }

    /**
     * Get Current Profile
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
