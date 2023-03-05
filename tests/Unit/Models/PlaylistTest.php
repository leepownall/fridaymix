<?php

use App\Models\Playlist;

it('can get theme', function ($name, $expected) {
    $playlist = new Playlist([
        'name' => $name,
    ]);

    expect($playlist->theme)->toBe($expected);
})->with([
    ['FM - Bodies of Water 🌊 18/11/22', 'Bodies of Water'],
    ['FM - Starts with an L 🗽 20/05/22', 'Starts with an L'],
    ['FM - 2022-07-08 - Songs by an artist/band with same first and last initials', 'Songs by an artist/band with same first and last initials'],
    ['FM - 2022-07-22 - Songs by artists/groups from Detroit 🇺🇸', 'Songs by artists/groups from Detroit'],
    ['WM - Royalty 👑 01/06/22', 'Royalty']
]);
