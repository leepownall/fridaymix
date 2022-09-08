<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $fillable = [
        'name',
        'email',
        'avatar',
        'external_url',
        'spotify_id',
        'spotify_token',
        'spotify_refresh_token',
    ];

    protected $hidden = [
        'spotify_token',
        'spotify_refresh_token',
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
