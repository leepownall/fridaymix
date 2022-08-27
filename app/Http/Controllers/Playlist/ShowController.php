<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Resources\PlaylistTrackResource;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use function gmdate;

class ShowController extends Controller
{
    public function __invoke(Request $request, Playlist $playlist): View
    {
        $playlist = $playlist->loadCount('tracks');
        $duration = gmdate('H \h\o\u\r\s, i \m\i\n\u\t\e\s \a\n\d s \s\e\c\o\n\d\s', $playlist->tracks->sum('duration_in_ms') / 1000);
        $contributors = $playlist->tracks->pluck('pivot')->pluck('user')->unique('id')->count();

        return view('playlists.tracks.index')
            ->with('playlist', $playlist)
            ->with('contributors', $contributors)
            ->with('duration', $duration);
    }
}
