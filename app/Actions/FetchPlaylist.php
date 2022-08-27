<?php

namespace App\Actions;

use App\DataTransferObjects\Playlist;
use Illuminate\Support\Arr;
use Spotify;

class FetchPlaylist
{
    public function __invoke(string $spotifyPlaylistId): Playlist
    {
        $playlist = Spotify::playlist($spotifyPlaylistId)->get();

        $images = Arr::get($playlist, 'images');

        return new Playlist(
            id: Arr::get($playlist, 'id'),
            name: Arr::get($playlist, 'name'),
            imageUrl: Arr::get(head($images), 'url'),
        );
    }
}
