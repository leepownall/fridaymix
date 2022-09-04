<?php

namespace App\Http\Livewire\Playlist;

use App\Actions\UpdatePlaylistAction;
use App\Http\Resources\PlaylistTrackResource;
use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Str;
use Livewire\Component;

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

    public $onlyDuplicates = false;

    public $hasDuplicates = false;

    public $tracksCount = 0;

    public $batchId = null;

    public $batchProgress = 0;

    public $batchFinished = false;

    public function mount(Playlist $playlist, ?string $batchId = null)
    {
        $this->batchId = $batchId;
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

        $tracks = $this
            ->playlist
            ->load(['tracks' => function ($query) {
                return $query
                    ->with('playlists:id,spotify_playlist_id,name')
                    ->withCount('playlists')
                    ->oldest('playlist_track.order');
            }])
            ->tracks
            ->each(function ($track) {
                if ($this->hasDuplicates === false) {
                    $this->hasDuplicates = $track->playlists_count > 1;
                }
            });

        $this->tracksCount = $tracks->count();

        $this->tracks = $tracks
            ->filter(function (Track $track) {
                if ($this->onlyDuplicates) {
                    return $track->playlists_count > 1;
                }

                return true;
            })
            ->filter(function (Track $track) {
                if ($this->search === '') {
                    return true;
                }

                return Str::contains($track->name, $this->search, true)
                    || Str::contains($track->album, $this->search, true);
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

    public function getImportBatchProperty()
    {
        if ($this->batchId === null) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateBatchProgress()
    {
        $this->batchProgress = $this->importBatch?->progress();

        if ($this->importBatch?->finished()) {
            $this->batchId = null;
            $this->batchProgress = 0;
        }
    }

    public function refreshPlaylist()
    {
        $this->tracks = null;
        $batch = resolve(UpdatePlaylistAction::class)($this->playlist, $this->playlist->starting_at);

        $this->batchId = $batch->id;
    }
}
