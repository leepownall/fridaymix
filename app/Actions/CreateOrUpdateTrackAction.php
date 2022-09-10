<?php

namespace App\Actions;

use App\Models\Track as TrackModel;
use App\Models\User;
use App\Track;

class CreateOrUpdateTrackAction
{
    public function __invoke(Track $track, User $user): TrackModel
    {
        $trackModel = TrackModel::firstWhere('isrc', $track->isrc);

        if ($trackModel !== null) {
            $trackModel->update([
                'name' => $track->name,
                'artists' => $track->artists,
                'album' => $track->album,
                'duration_in_ms' => $track->durationInMs,
                'image_url' => $track->imageUrl,
                'isrc' => $track->isrc,
            ]);

            return $trackModel;
        }

        return TrackModel::create([
            'spotify_id' => $track->id,
            'isrc' => $track->isrc,
            'user_id' => $user->id,
            'added_at' => $track->addedAt,
            'name' => $track->name,
            'artists' => $track->artists,
            'album' => $track->album,
            'duration_in_ms' => $track->durationInMs,
            'image_url' => $track->imageUrl,
        ]);
    }
}
