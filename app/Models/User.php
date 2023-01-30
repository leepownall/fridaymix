<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public $fillable = [
        'name',
        'email',
        'avatar',
        'external_url',
        'spotify_id',
        'password',
        'email_verified_at',
        'remember_token',
    ];

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class);
    }

    public function playlistTracks()
    {
        return $this
            ->hasMany(Playlist::class)
            ->using(PlaylistTrack::class);
    }

    public function playlists(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
