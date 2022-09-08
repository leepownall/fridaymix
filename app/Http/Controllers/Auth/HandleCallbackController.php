<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class HandleCallbackController extends Controller
{
    public function __invoke()
    {
        $spotifyUser = Socialite::driver('spotify')->user();

        $user = User::updateOrCreate([
            'spotify_id' => $spotifyUser->getId(),
        ], [
            'name' => $spotifyUser->getName(),
            'email' => $spotifyUser->getEmail(),
            'avatar' => $spotifyUser->getAvatar(),
            'external_url' => Arr::get($spotifyUser->user, 'external_urls.spotify'),
            'spotify_token' => $spotifyUser->token,
            'spotify_refresh_token' => $spotifyUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
