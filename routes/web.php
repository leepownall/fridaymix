<?php

use App\Http\Controllers\Playlist;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Track;
use App\Http\Livewire\SongSuggestion;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/playlists');

Route::prefix('playlists')->group(function () {
    Route::get('/', Playlist\IndexController::class)->name('playlists.index');
    Route::get('/show/{playlist}', Playlist\ShowController::class)->name('playlists.show');

    Route::get('/create', Playlist\CreateController::class)->name('playlists.create');
    Route::get('/{playlist}/song-suggestion', SongSuggestion::class)
        ->name('playlists.song-suggestion');
});

Route::get('tracks', Track\IndexController::class)->name('tracks.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('time', function () {
   echo now()->format('Y-m-d H:i:s');
});

require __DIR__.'/auth.php';
