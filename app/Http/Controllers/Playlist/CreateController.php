<?php

namespace App\Http\Controllers\Playlist;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke(): View
    {
        return view('playlists.create');
    }
}
