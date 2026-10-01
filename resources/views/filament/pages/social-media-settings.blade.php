<x-filament::page>
    <div class="max-w-5xl mx-auto">
        <div class="mb-6 rounded-lg border border-warning-300 bg-warning-50 p-4 text-sm text-warning-900">
            Add the complete social profile URLs here. Saved links will be used by the website footer and the WhatsApp support card.
        </div>

        {{ $this->form }}

        <div class="flex justify-end mt-8">
            <x-filament::button class="px-5 py-2.5" wire:click="save" wire:loading.attr="disabled">
                Save social links
            </x-filament::button>
        </div>
    </div>
</x-filament::page>
