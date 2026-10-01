<x-filament::page>
    <div class="max-w-5xl mx-auto">
        <div class="mb-6 rounded-lg border border-warning-300 bg-warning-50 p-4 text-sm text-warning-900">
            Add your Finnhub API key here to publish live economic-calendar events on the public News page. The key is encrypted in the database and is never shown after saving.
        </div>

        {{ $this->form }}

        <div class="flex justify-end mt-6">
            <x-filament::button wire:click="save" wire:loading.attr="disabled">
                Save calendar settings
            </x-filament::button>
        </div>
    </div>
</x-filament::page>
