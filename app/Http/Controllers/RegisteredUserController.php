<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request): RedirectResponse
    {
        $user = DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => $validated['role'],
            ]);

            if ($validated['role'] === 'employer') {
                $logoPath = $request->file('logo') 
                    ? $request->file('logo')->store('logos', 'public') 
                    : null;

                $user->employer()->create([
                    'name' => $validated['employer'],
                    'logo' => $logoPath,
                ]);
            }

            return $user;
        });

        Auth::login($user);

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Welcome ' . $user->name . '! Your account has been created successfully.');;
    }
}