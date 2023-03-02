<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

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

    protected $casts = [
        'starting_at' => 'datetime',
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

    public function getThemeAttribute(): string
    {
        $unicodeRegexp = '([*#0-9](?>\\xEF\\xB8\\x8F)?\\xE2\\x83\\xA3|\\xC2[\\xA9\\xAE]|\\xE2..(\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?>\\xEF\\xB8\\x8F)?|\\xE3(?>\\x80[\\xB0\\xBD]|\\x8A[\\x97\\x99])(?>\\xEF\\xB8\\x8F)?|\\xF0\\x9F(?>[\\x80-\\x86].(?>\\xEF\\xB8\\x8F)?|\\x87.\\xF0\\x9F\\x87.|..(\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|(((?<zwj>\\xE2\\x80\\x8D)\\xE2\\x9D\\xA4\\xEF\\xB8\\x8F\k<zwj>\\xF0\\x9F..(\k<zwj>\\xF0\\x9F\\x91.)?|(\\xE2\\x80\\x8D\\xF0\\x9F\\x91.){2,3}))?))';

        $string = Str::of($this->name)->after('FM - ')->toString();

        preg_match($unicodeRegexp, $string, $matches);

        return Str::of($string)->before($matches[0])->trim()->toString();
    }

    public function getSongsToSkipAttribute(): string
    {
        return $this
            ->tracks
            ->map(function (Track $track) {
                return "{$track->name} by {$track->artists}";
            })
            ->implode(', ');
    }

    public function getOpenAiPromptAttribute(): string
    {
        return "Return one suggestion for songs about {$this->theme} but do not include {$this->songs_to_skip}";
    }
}
