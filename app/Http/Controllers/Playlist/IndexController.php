<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $playlists = Playlist::query()
            ->latest('starting_at')
            ->get();

        return view('playlists.index')->with('playlists', $playlists);
    }
}
