<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\List_Data_Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $kab_kota = List_Data_Controller::list_kab_kota();
        return view('auth.register', [
            'kab_kota' => $kab_kota
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'kab_kota' => ['required'],
            'no_hp' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kab_kota' => $request->kab_kota,
            'no_hp' => $request->no_hp
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        if (Auth::user()->hasRole('user')) {
            return redirect()->route('user.beranda');
        }

        return redirect(route('dashboard', absolute: false));
    }
}
