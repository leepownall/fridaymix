<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class Track
{
    public Carbon $addedAt;

    public string $addedBy;

    public string $id;

    public string $name;

    public string $artists;

    public string $album;

    public int $durationInMs;

    public string $readableDuration;

    public ?string $imageUrl;

    public function __construct($data)
    {
        $this->id = Arr::get($data, 'track.id');
        $this->name = Arr::get($data, 'track.name');
        $this->addedBy =  Arr::get($data, 'added_by.id');
        $this->addedAt = Carbon::parse(Arr::get($data, 'added_by.date'));
        $this->album = Arr::get($data, 'track.album.name');
        $this->artists = collect(Arr::get($data, 'track.artists'))->pluck('name')->implode(', ');
        $this->durationInMs = Arr::get($data, 'track.duration_ms');
        $this->readableDuration = Carbon::parse(Arr::get($data, 'track.duration_ms') / 1000)->format('i:s');
        $this->imageUrl = head(Arr::get($data, 'track.album.images'))['url'];
    }
}
