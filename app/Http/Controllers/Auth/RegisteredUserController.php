<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Citizen;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $citizenRole = Role::where('slug', Role::CITIZEN)->firstOrFail();

        $user = DB::transaction(function () use ($request, $citizenRole) {
            $user = User::create([
                'name' => $request->string('name')->toString(),
                'email' => $request->string('email')->toString(),
                'password' => $request->string('password')->toString(),
                'role_id' => $citizenRole->id,
                'status' => 'active',
            ]);

            Citizen::create([
                'user_id' => $user->id,
                'national_id' => $request->string('national_id')->toString(),
                'address' => $request->string('address')->toString(),
                'contact' => $request->string('contact')->toString(),
                'date_of_birth' => $request->date('date_of_birth'),
            ]);

            return $user;
        });

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
