<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Spotify;
use function config;

class IndexController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $playlists = Spotify::userPlaylists(config('where.start_time'))->get();

        $playlists = collect($playlists['items'])
            ->map(function ($playlist) {
                return [
                    'id' => $playlist['id'],
                    'name' => $playlist['name'],
                ];
            })
            ->toArray();

        return Inertia::render('Playlists/Index', [
            'playlists' => $playlists,
        ]);
    }
}
