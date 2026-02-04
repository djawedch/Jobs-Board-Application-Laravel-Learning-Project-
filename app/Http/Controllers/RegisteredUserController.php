<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\{Auth, DB};

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        DB::transaction(function () use ($request) 
        {
            $user = User::create(
                $request->validated(['name', 'email', 'password'])
            );

            $logoPath = $request->file('logo')->store('logos');

            $user->employer()->create([
                'name' => $request->employer,
                'logo' => $logoPath,
            ]);

            Auth::login($user);
        });

        return redirect()->route('jobs.index');
    }
}
