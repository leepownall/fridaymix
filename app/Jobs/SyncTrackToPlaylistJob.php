<?php

namespace App\Jobs;

use App\Actions\CreateOrUpdateTrackAction;
use App\Actions\CreateOrUpdateUserAction;
use App\Models\Playlist;
use App\Track;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function resolve;

class SyncTrackToPlaylistJob implements ShouldQueue, ShouldBeUnique
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Playlist $playlist, public Track $track)
    {
    }

    /**
     * The unique ID of the job.
     */
    public function uniqueId(): string
    {
        return $this->playlist->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = resolve(CreateOrUpdateUserAction::class)($this->track->addedBy);

        $trackModel = resolve(CreateOrUpdateTrackAction::class)($this->track, $user);

        $duration = $this
            ->playlist
            ->tracks()
            ->where('order', '<', $this->track->position)
            ->sum('duration_in_ms');

        $startsAt = $this
            ->playlist
            ->starting_at
            ->addMilliseconds($duration);

        $endsAt = $startsAt->clone()->addMilliseconds($this->track->durationInMs);

        $this->playlist->tracks()->save($trackModel, [
            'user_id' => $user->id,
            'added_at' => $this->track->addedAt,
            'order' => $this->track->position,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ]);
    }
}
