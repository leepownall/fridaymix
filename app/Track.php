<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class Track
{
    public string $id;

    public Carbon $addedAt;

    public string $addedBy;

    public string $name;

    public string $artists;

    public string $album;

    public int $durationInMs;

    public ?string $imageUrl;

    public int $position;

    public string $isrc;

    public function __construct($data, int $position)
    {
        $this->id = Arr::get($data, 'track.id');
        $this->name = Arr::get($data, 'track.name');
        $this->addedBy = Arr::get($data, 'added_by.id');
        $this->addedAt = Carbon::parse(Arr::get($data, 'added_at'));
        $this->album = Arr::get($data, 'track.album.name');
        $this->artists = collect(Arr::get($data, 'track.artists'))->pluck('name')->implode(', ');
        $this->durationInMs = Arr::get($data, 'track.duration_ms');
        $this->imageUrl = Arr::get($data, 'track.album.images.0.url');
        $this->isrc = Arr::get($data, 'track.external_ids.isrc');
        $this->position = $position;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
