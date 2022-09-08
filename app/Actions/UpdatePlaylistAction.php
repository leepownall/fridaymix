<?php

namespace App\Actions;

use App\Jobs\AddTrackToPlaylistJob;
use App\Models\Playlist;
use App\Models\User;
use App\Track;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Bus;
use Spotify;

class UpdatePlaylistAction
{
    public function __invoke(Playlist $playlistModel, string $startingAt): Batch
    {
        $playlist = Spotify::playlist($playlistModel->spotify_playlist_id)->get();

        $playlistModel->update([
            'name' => $playlist['name'],
            'image_url' => Arr::get($playlist, 'images.0.url'),
            'external_url' => $playlist['external_urls']['spotify'],
            'starting_at' => Carbon::parse($startingAt),
        ]);

        $playlistModel->tracks()->detach();

        $createTracks = collect($playlist['tracks']['items'])
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

        return Bus::batch($createTracks)->name($playlist['name'])->dispatch();
    }
}
