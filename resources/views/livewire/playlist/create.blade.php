<div class="w-full p-6 lg:w-1/4 mx-auto">
    <x-form wire:submit.prevent="submit">
        <div class="flex flex-col space-y-6">
            <x-input.group
                label="Playlist Id"
                for="spotify_playlist_id"
                :error="$errors->first('playlistId')"
            >
                <x-input.text wire:model="playlistId" name="spotify_playlist_id" />
            </x-input.group>
            <x-input.group
                label="Starting at"
                for="starting_at"
                :error="$errors->first('startingAt')"
            >
                <x-input.date-time wire:model="startingAt" name="starting_at" />
            </x-input.group>
            <x-button.primary type="submit" class="mt-4">Add</x-button.primary>
        </div>
    </x-form>
</div>
