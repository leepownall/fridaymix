<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use function now;

class PlaylistTrack extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function playlist(): BelongsTo
    {
        return $this->belongsTo(Playlist::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStartsAtTimestampAttribute(): int
    {
        return $this->starts_at->timestamp;
    }

    public function getEndsAtTimestampAttribute(): int
    {
        return $this->ends_at->timestamp;
    }

    public function getIsCurrentAttribute(): bool
    {
        return now()->between($this->starts_at, $this->ends_at);
    }

    public function getCurrentTimeAttribute(): ?string
    {
        if ($this->is_current === false) {
            return null;
        }

        $diff = now()->diffAsCarbonInterval($this->starts_at);

        $minutes = str($diff->i)->padLeft(2, 0);
        $seconds = str($diff->s)->padLeft(2, 0);

        return "{$minutes}:{$seconds}";
    }
}
