<?php

namespace App\Rules;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use Illuminate\Contracts\Validation\Rule;
use Spotify;

class ValidPlaylistId implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            Spotify::playlist($value)->get();
        } catch (SpotifyApiException) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The playlist given does not exist.';
    }
}
