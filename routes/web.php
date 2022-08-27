<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Playlist;
use App\Http\Controllers\Track;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::redirect('/', '/playlist');

Route::get('/login', function () {
    return Socialite::driver('spotify')->redirect();
})->name('login');

Route::post('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();

    redirect('/');
})->name('logout');

Route::get('/auth/callback', Auth\HandleCallbackController::class);

Route::prefix('playlist')->group(function () {
    Route::get('/', Playlist\IndexController::class)->name('playlists.index');
    Route::get('/show/{playlist}', Playlist\ShowController::class)->name('playlists.show');

    Route::get('/create', Playlist\CreateController::class  )
        ->name('playlists.create')
        ->middleware('auth');
});

Route::get('tracks', Track\IndexController::class)->name('tracks.index');



//Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
//Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
