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
        return view('playlists.tracks.index')
            ->with('playlist', $playlist)
            ->with('batchId', $request->get('batchId'));
    }
}
