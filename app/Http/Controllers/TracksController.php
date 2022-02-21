<?php

namespace App\Http\Controllers;

use App\Track;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use Spotify;
use function config;


class TracksController extends Controller
{
    public function show(Request $request, string $playlist): Response
    {
        $tracks = Spotify::playlistTracks($playlist)->get();

        $startTime = Carbon::parse(Cache::get('startTime'));

        $tracks = collect($tracks['items'])
            ->mapInto(Track::class)
            ->map(function (Track $track) use ($startTime) {
                $track->startsAt = $startTime->toTimeString();
                $track->endsAt = $startTime->addMilliseconds($track->durationInMs)->toTimeString();

                $track->isCurrent = now()->between(Carbon::parse($track->startsAt), Carbon::parse($track->endsAt));
                $diff = now()->diffAsCarbonInterval(Carbon::parse($track->startsAt));

                $track->hasPassed = now()->gt($track->endsAt);
                $minutes = str($diff->i)->padLeft(2, 0);
                $seconds = str($diff->s)->padLeft(2, 0);
                $track->currentPosition = "{$minutes}:{$seconds}";
                return $track;
            })
            ->toArray();

        return Inertia::render('Tracks/Show', [
            'tracks' => $tracks,
            'currentTime'
        ]);
    }
}
