<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'spotify_id',
        'isrc',
        'user_id',
        'name',
        'artists',
        'album',
        'duration_in_ms',
        'image_url',
        'added_at',
    ];

    protected $casts = [
      'added_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function playlists(): BelongsToMany
    {
        return $this
            ->belongsToMany(Playlist::class)
            ->withPivot(['user_id'])
            ->using(PlaylistTrack::class);
    }

    public function getDurationAttribute(): string
    {
        return gmdate('i \m\i\n\u\t\e\s s \s\e\c\o\n\d\s', $this->duration_in_ms / 1000);
    }
}
