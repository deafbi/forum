<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'max:16', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            // 'name' => $request->name,
            // 'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('member');

        $user->last_login_at = now();
        // $user->last_login_ip = $request->ip();
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home'));
    }

    // Add this method for showing the Terms of Service view
    public function showTos(): View
    {
        return view('auth.tos');
    }

    // Add this method for handling the Terms of Service acceptance
    public function acceptTos(Request $request): RedirectResponse
    {
        $request->validate([
            'accept_tos' => ['accepted'],
        ]);

        // Store the acceptance status in the session
        $request->session()->put('tos_accepted', true);

        return redirect(route('register'));
    }
}
