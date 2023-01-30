<div class="p-8">
        <div class="flex flex-col space-y-6">
            <x-input.group
                label="Starting at"
                for="starting_at"
                :error="$errors->first('startingAt')"
            >
                <x-input.date-time wire:model="startingAt" name="starting_at" :value="$startingAt" />
            </x-input.group>
            <x-input.group>
                <x-button.primary wire:click="update" class="w-full md:w-auto">Update</x-button.primary>
            </x-input.group>
        </div>
</div>
