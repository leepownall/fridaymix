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
        $users = User::query()
            ->select(['id', 'spotify_id', 'name'])
            ->whereNull('password')
            ->get();

        return view('auth.register')->with('users', $users);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'spotify_id' => ['required', 'exists:users,spotify_id']
        ], [
            'spotify_id.required' => 'The spotify account field is required.',
            'spotify_id.exists' => 'The selected spotify account is invalid.'
        ]);

        if ($request->filled('spotify_id')) {
            $user = User::query()->firstWhere('spotify_id', $request->get('spotify_id'));

            $user->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
