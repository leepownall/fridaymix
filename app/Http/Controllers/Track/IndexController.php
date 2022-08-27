<?php

namespace App\Http\Controllers\Track;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\User;
use Illuminate\View\View;
use function dd;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $trackCount = Track::query()->count();
        $userCount = User::query()->count();
        $duration = gmdate('H \h\o\u\r\s, i \m\i\n\u\t\e\s \a\n\d s \s\e\c\o\n\d\s', Track::query()->select('duration_in_ms')->sum('duration_in_ms'));


        return view('tracks.index')
            ->with('trackCount', $trackCount)
            ->with('userCount', $userCount)
            ->with('duration', $duration);
    }
}
