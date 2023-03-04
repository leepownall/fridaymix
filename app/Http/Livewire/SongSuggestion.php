<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Spotify;
use App\Models\Playlist;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use function session;

class SongSuggestion extends Component
{
    public $playlistId = '';

    public $songsToSkip = '';

    public string $theme;

    public string $prompt;

    public string $answer = '';

    public string $link = '';

    public function mount(Playlist $playlist)
    {
        $this->playlistId = $playlist->id;
        $this->songsToSkip = $playlist->songs_to_skip;
        $this->theme = $playlist->theme;
        $this->prompt = $playlist->open_ai_prompt;
    }

    public function getSuggestions()
    {
        $this->answer = '';

        $messages = session()->get("{$this->playlistId}-messages", function () {
            return [
                [
                    'role' => 'system',
                    'content' => "You are Friday Mix - A song suggestion service. Answer as concisely as possible. Provide only one suggestion at a time. Suggest songs with the theme of {$this->theme} but don't include {$this->songsToSkip}."
                ]
            ];
        });

        $messages[] = ['role' => 'user', 'content' => $this->prompt];

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
        ]);

        $this->answer = $response->choices[0]->message->content;

        $messages[] = ['role' => 'assistant', 'content' => $this->answer];

        session()->put("{$this->playlistId}-messages", $messages);

        $find = Spotify::searchTracks($this->answer)->limit(1)->get();

        $this->link = Arr::get($find, 'tracks.items.0.external_urls.spotify');
    }

    public function render()
    {
        return view('livewire.song-suggestion');
    }
}
