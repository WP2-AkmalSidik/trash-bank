<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->expectsJson()) {
                return response()->json([
                    'redirect' => $this->getRedirectUrlBasedOnRole(Auth::user())
                ]);
            }

            return $this->redirectBasedOnRole(Auth::user());
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Email atau password yang Anda masukkan salah.'
            ], 401);
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Get redirect URL based on role.
     */
    private function getRedirectUrlBasedOnRole($user)
    {
        if ($user->isAdmin()) {
            return route('admin.dashboard');
        }

        return route('user.dashboard');
    }

    /**
     * Redirect user based on role.
     */
    private function redirectBasedOnRole($user)
    {
        return redirect($this->getRedirectUrlBasedOnRole($user));
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}