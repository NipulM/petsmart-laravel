<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Generate token for API access
        $token = $request->user()->createToken('auth-token')->plainTextToken;

        // Store token in session for JavaScript to access
        session()->put('api_token', $token);

        // Flash the token to the session so it persists for the next request
        session()->flash('api_token', $token);

        return redirect()->intended(route('dashboard', absolute: false))
            ->with('api_token', $token); // This ensures the token is available in the redirected view
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Delete all tokens for the user
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
