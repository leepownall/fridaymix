<?php

namespace App\DataTransferObjects;

use App\Track;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Tracks
{
    private int $total;

    private Collection $items;

    public function __construct(array $tracks)
    {
        $this->items = collect(Arr::get($tracks, 'items'))
            ->map(function (array $track): Track {
                return new Track($track);
            });

        $this->total = Arr::get($tracks, 'total');

    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
