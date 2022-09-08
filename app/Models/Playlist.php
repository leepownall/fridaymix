<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
        'external_url',
        'spotify_playlist_id',
        'starting_at',
    ];

    protected $dates = [
        'starting_at',
    ];

    public function getRouteKeyName(): string
    {
        return 'spotify_playlist_id';
    }

    public function tracks(): BelongsToMany
    {
        return $this
            ->belongsToMany(Track::class)
            ->withPivot(['added_at', 'order', 'starts_at', 'ends_at', 'user_id'])
            ->using(PlaylistTrack::class)
            ->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getEndingAtAttribute(): ?Carbon
    {
        return $this->tracks?->last()?->pivot->ends_at;
    }
}
