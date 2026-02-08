<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\View\View;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginUserRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match',
            ]);
        }

        $request->session()->regenerate();

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Welcome back!');
        ;
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('jobs.index')
            ->with('success', 'You have been logged out.');
    }
}