<?php

namespace App\Actions;

use App\Jobs\AddTrackToPlaylistJob;
use App\Models\Playlist;
use App\Track;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Bus;
use Spotify;

class CreatePlaylistAction
{
    public function __invoke(string $playlistId, string $startingAt): array
    {
        $playlist = Spotify::playlist($playlistId)->get();

        $user = resolve(CreateOrUpdateUserAction::class)(Arr::get($playlist, 'owner.id'));

        $playlistModel = new Playlist([
            'name' => $playlist['name'],
            'image_url' => Arr::get($playlist, 'images.2.url'),
            'external_url' => $playlist['external_urls']['spotify'],
            'spotify_playlist_id' => $playlistId,
            'starting_at' => Carbon::parse($startingAt),
        ]);

        $user->playlists()->save($playlistModel);

        $tracks = Spotify::playlistTracks($playlistId)->get();

        $createTracks = collect($tracks['items'])
            ->map(function ($track, $index) {
                return new Track($track, $index + 1);
            })
            ->map(function ($track) use ($playlistModel) {
                return new AddTrackToPlaylistJob(
                    playlist: $playlistModel,
                    track: $track,
                );
            })
            ->toArray();

        return [$playlistModel, Bus::batch($createTracks)->name($playlist['name'])->dispatch()];
    }
}
