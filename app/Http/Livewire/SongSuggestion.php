<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Spotify;
use App\Models\Playlist;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class SongSuggestion extends Component
{
    public string $theme;

    public string $prompt;

    public string $answer = '';

    public string $link = '';

    public function mount(Playlist $playlist)
    {
        $this->theme = $playlist->theme;
        $this->prompt = $playlist->open_ai_prompt;
    }

    public function getSuggestions()
    {
        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $this->prompt,
        ]);

        $this->answer = $result['choices'][0]['text'];

        $find = Spotify::searchTracks($this->answer)->limit(1)->get();

        $this->link = Arr::get($find, 'tracks.items.0.external_urls.spotify');
    }

    public function render()
    {
        return view('livewire.song-suggestion');
    }
}
