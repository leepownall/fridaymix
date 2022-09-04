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
use Illuminate\Support\Str;
use Livewire\Component;
use Spotify;

class CreatePlaylist extends Component
{
    public $playlistUrl;

    public $playlistId = '';

    public $startingAt;

    public function mount()
    {
        $this->startingAt = Carbon::now()
            ->next('friday')
            ->setTime(14, 00)
            ->toDateTimeLocalString('minute');
    }

    public function updatedPlaylistUrl()
    {
        $this->playlistId = Str::of($this->playlistUrl)->between('/playlist/', '?si=')->toString();
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

        [$playlistModel, $batch] = resolve(CreatePlaylistAction::class)($this->playlistId, $this->startingAt);

        return redirect()->route('playlists.show', ['playlist' => $playlistModel, 'batchId' => $batch->id]);
    }

    public function render()
    {
        return view('livewire.playlist.create');
    }
}
