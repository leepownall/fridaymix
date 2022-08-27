<?php

namespace App\Http\Livewire;

use App\Models\Track;
use Livewire\Component;
use Livewire\WithPagination;

class Tracks extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tracks', [
            'tracks' => Track::query()
                ->when($this->search !== '', function ($query) {
                    $query
                        ->where('name', 'LIKE', "%{$this->search}%")
                        ->orWhere('spotify_id', '=', $this->search);
                })
                ->latest('added_at')
                ->simplePaginate(30)
        ]);
    }
}
