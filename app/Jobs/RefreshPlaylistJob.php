<?php

namespace App\Jobs;

use App\Actions\UpdatePlaylistAction;
use App\Models\Playlist;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefreshPlaylistJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public string $playlistId, public string $startingAt)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UpdatePlaylistAction $action)
    {
        $action(Playlist::firstWhere('spotify_playlist_id', $this->playlistId), $this->startingAt);
    }
}
