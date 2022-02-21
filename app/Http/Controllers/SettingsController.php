<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class SettingsController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Settings/Edit', [
            'username' => Cache::get('username', 'timprint'),
            'startTime' => Cache::get('startTime', '14:00'),
        ]);
    }

    public function update(UpdateSettingsRequest $request): RedirectResponse
    {
        Cache::put('username', $request->validated('username'));
        Cache::put('startTime', $request->validated('startTime'));

        return redirect()->route('playlists.index');
    }
}
