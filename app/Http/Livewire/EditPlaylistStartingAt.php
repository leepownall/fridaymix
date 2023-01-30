<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LivewireUI\Modal\ModalComponent;

class EditPlaylistStartingAt extends ModalComponent
{
    use AuthorizesRequests;

    public $playlist;

    public $startingAt;

    public function mount($playlist)
    {
        $this->playlist = Playlist::query()->find($playlist);
        $this->startingAt = $this->playlist->starting_at->toDateTimeLocalString('minute');
    }

    public function update()
    {
        $this->authorize('update', $this->playlist);

        $this->validate([
            'startingAt' => [
                'required',
                'date_format:Y-m-d\TH:i',
            ],
        ]);

        $this->playlist->update([
            'starting_at' => $this->startingAt,
        ]);

        $this->emit('refreshPlaylist');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-playlist-starting-at');
    }
}
