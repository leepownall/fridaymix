<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistTrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $playlists = $this
            ->playlists
            ->reject(function ($playlist) use ($request) {
                return $this->pivot->playlist_id === $playlist?->id;
            });

        return [
            'id' => $this->id,
            'name' => $this->name,
            'artists' => $this->artists,
            'album' => $this->album,
            'duration_in_ms' => $this->duration_in_ms,
            'duration' => gmdate('i:s', $this->duration_in_ms / 1000),
            'readable_duration' => gmdate('i \m\i\n\u\t\e\s s \s\e\c\o\n\d\s', $this->duration_in_ms / 1000),
            'image_url' => $this->image_url,
            'added_at' => $this->added_at->format('D, d M Y H:i'),
            'is_current' => $this->pivot->is_current,
            'current_time' => $this->pivot->current_time,
            'starts_at' => $this->pivot->starts_at->format('H:i:s'),
            'starts_at_timestamp' => $this->pivot->starts_at->getTimestampMs(),
            'ends_at_timestamp' => $this->pivot->ends_at->getTimestampMs(),
            'user_id' => $this->pivot->user->name,
            'added_by' => $this->pivot->user->name,
            'related' => RelatedPlaylistResource::collection($playlists),
        ];
    }
}
