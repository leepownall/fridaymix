<?php

namespace App\Http\Livewire\Playlist;

use App\Actions\CreatePlaylistAction;
use App\Jobs\AddTrackToPlaylistJob;
use App\Models\Playlist;
use App\Models\User;
use App\Rules\ValidPlaylistId;
use App\Track;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Spotify;

class CreatePlaylist extends Component
{
    public $playlistId;

    public $startingAt;

    public function mount()
    {
        $this->startingAt = Carbon::now()
            ->next('friday')
            ->setTime(14, 00)
            ->toDateTimeLocalString('minute');
    }

    public function submit()
    {
        $this->validate(
            rules: [
                'playlistId' => [
                    'required',
                    'unique:playlists,spotify_playlist_id',
                    new ValidPlaylistId(),
                ],
                'startingAt' => [
                    'required',
                    'date_format:Y-m-d\TH:i',
                ],
            ],
            attributes: [
                'playlistId' => 'playlist',
            ]
        );

        $playlistModel = resolve(CreatePlaylistAction::class)($this->playlistId, $this->startingAt);

        return redirect()->route('playlists.show', ['playlist' => $playlistModel]);
    }

    public function render()
    {
        return view('livewire.playlist.create');
    }
}
