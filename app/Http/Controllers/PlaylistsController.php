<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use Spotify;

class PlaylistsController extends Controller
{
    public function index(): Response
    {
        $playlists = Spotify::userPlaylists(Cache::get('username'))->get();

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
