<?php

namespace App\Http\Livewire\Playlist;

use App\Actions\UpdatePlaylistAction;
use App\Http\Resources\PlaylistTrackResource;
use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use function now;
use function resolve;

class Tracks extends Component
{
    protected $queryString = [
        'search' => ['except' => ''],
        'addedBy' => ['except' => ''],
        'onlyUpcoming' => ['except' => false],
    ];

    public $playlist;

    public $tracks;

    public $users;

    public $addedBy = '';

    public $search = '';

    public $onlyUpcoming = false;

    public $isCurrentlyPlaying = false;

    public $tracksCount = 0;

    public function mount(Playlist $playlist)
    {
        $this->playlist = $playlist;
        $this->isCurrentlyPlaying = now()->between($playlist->starting_at, $playlist->ending_at);
    }

    public function render()
    {
        $this->users = $this
            ->playlist
            ->tracks
            ->pluck('pivot')
            ->pluck('user')
            ->unique('id')
            ->values()
            ->mapWithKeys(function (User $user) {
                return [
                    $user->id => $user->name,
                ];
            })
            ->toArray();

        $tracks = $this->playlist
            ->load(['tracks' => function ($query) {
                return $query
                    ->with('playlists:id,spotify_playlist_id,name')
                    ->withCount('playlists')
                    ->oldest('playlist_track.order');
            }])
            ->tracks;

        $this->tracksCount = $tracks->count();

        $this->tracks = $tracks
            ->filter(function (Track $track) {
                if ($this->search === '') {
                    return true;
                }

                return Str::contains($track->name, $this->search, true);
            })
            ->filter(function (Track $track) {
                if ($this->addedBy === '') {
                    return true;
                }

                return $track->pivot->user->id == $this->addedBy;
            })
            ->when($this->isCurrentlyPlaying, function ($tracks) {
                return $tracks->filter(function (Track $track) {
                    if ($this->onlyUpcoming === false) {
                        return true;
                    }

                    return $track->pivot->ends_at->gte(now());
                });
            })
            ->map(function (Track $track) {
                return PlaylistTrackResource::make($track);
            })
            ->values()
            ->toArray();

        return view('livewire.playlist.tracks');
    }

    public function refreshPlaylist()
    {
        resolve(UpdatePlaylistAction::class)($this->playlist, $this->playlist->starting_at);

        return redirect()->route('playlists.show', $this->playlist);
    }
}
