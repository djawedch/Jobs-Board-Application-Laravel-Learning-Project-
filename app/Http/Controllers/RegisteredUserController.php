<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\{Auth, DB, Hash};

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $user = DB::transaction(function () use ($request) 
        {
            $validated = $request->validated();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $logoPath = $request->file('logo')->store('logos');

            $user->employer()->create([
                'name' => $validated['employer'],
                'logo' => $logoPath,
            ]);

            return $user;
        });

        Auth::login($user);

        return redirect()->route('jobs.index');
    }
}
