<div class="max-w-xl mx-auto py-6 px-4 sm:px-0">
    <x-form wire:submit.prevent="submit">
        <div class="flex flex-col space-y-6">
            <x-input.group
                label="Playlist Url"
                for="playlist_url"
                help="Full link to playlist, copied from Share -> Copy link to playlist"
                :error="$errors->first('playlistId')"
            >
                <x-input.text wire:model="playlistUrl" name="playlist_url" />
            </x-input.group>
            <x-input.group
                label="Starting at"
                for="starting_at"
                :error="$errors->first('startingAt')"
            >
                <x-input.date-time wire:model="startingAt" name="starting_at" />
            </x-input.group>
            <x-input.group>
                <x-button.primary type="submit" class="w-full md:w-auto">Add</x-button.primary>
            </x-input.group>
        </div>
    </x-form>
</div>
