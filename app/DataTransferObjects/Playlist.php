<?php

namespace App\DataTransferObjects;

class Playlist
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $imageUrl
    ) {}
}
