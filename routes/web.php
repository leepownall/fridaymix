<?php

use App\Http\Controllers\PlaylistsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TracksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlaylistsController::class, 'index'])->name('playlists.index');
Route::get('/show/{playlist}', [TracksController::class, 'show'])->name('playlists.show');
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
