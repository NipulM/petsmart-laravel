<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function regenerate(Request $request)
    {
        try {
            $user = null;
            $oldToken = $request->input('old_token');

            if ($oldToken) {
                // Try to find user by old token
                $user = User::where('api_token', $oldToken)->first();
            }

            // If no user found by token, try to get authenticated user
            if (!$user && Auth::check()) {
                $user = Auth::user();
            }

            if (!$user) {
                return response()->json(['error' => 'No valid user found'], 401);
            }

            // Generate new token
            $newToken = $user->createToken('api_token')->plainTextToken;

            // Update session
            session(['api_token' => $newToken]);

            return response()->json([
                'token' => $newToken,
                'message' => 'Token regenerated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to regenerate token'], 500);
        }
    }
}
