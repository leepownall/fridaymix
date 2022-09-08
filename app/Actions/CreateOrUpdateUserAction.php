<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Arr;
use Spotify;

class CreateOrUpdateUserAction
{
    public function __invoke(string $id)
    {
        $user = Spotify::user($id)->get();

        return User::updateOrCreate([
            'spotify_id' => Arr::get($user, 'id'),
        ], [
            'name' => Arr::get($user, 'display_name'),
            'external_url' => Arr::get($user, 'external_urls.spotify'),
            'avatar' => Arr::get($user, 'images.0.url'),
        ]);
    }
}
