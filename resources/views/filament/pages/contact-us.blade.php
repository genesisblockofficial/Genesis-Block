<x-filament::page>
    <div class="max-w-6xl mx-auto">
        {{ $this->form }}

        <div class="flex" style="justify-content: flex-end; margin-top: 1.5rem;">
            <x-filament::button wire:click="save">
                Save Changes
            </x-filament::button>
        </div>
    </div>
</x-filament::page>
