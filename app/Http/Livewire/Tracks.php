<?php

namespace App\Http\Livewire;

use App\Models\Track;
use Livewire\Component;
use Livewire\WithPagination;

class Tracks extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
        'onlyDuplicates' => ['except' => false],
    ];

    public string $search = '';

    public bool $onlyDuplicates = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tracks', [
            'tracks' => Track::query()
                ->with(['playlists', 'playlists.tracks'])
                ->withCount('playlists')
                ->when($this->search !== '' && $this->onlyDuplicates === false, function ($query) {
                    $query
                        ->where('name', 'LIKE', "%{$this->search}%")
                        ->orWhere('spotify_id', '=', $this->search);
                })
                ->when($this->onlyDuplicates && $this->search === '' , function ($query) {
                    $query->where('playlists_count', '>', 1);
                })
                ->when($this->onlyDuplicates && $this->search !== '' , function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where('name', 'LIKE', "%{$this->search}%")
                            ->orWhere('spotify_id', '=', $this->search);
                    })
                        ->where('playlists_count', '>', 1);
                })
                ->latest('added_at')
                ->simplePaginate(30)
        ]);
    }
}
