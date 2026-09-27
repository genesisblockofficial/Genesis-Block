<x-filament::page>
    <div class="max-w-5xl mx-auto">
        <div class="mb-6 rounded-lg border border-warning-300 bg-warning-50 p-4 text-sm text-warning-900">
            Never paste Stripe keys into messages or commit them to Git. Secret and webhook keys are encrypted in the database and are not loaded back into these fields.
        </div>

        {{ $this->form }}

        <div class="flex justify-end mt-6">
            <x-filament::button wire:click="save" wire:loading.attr="disabled">
                Save Stripe settings
            </x-filament::button>
        </div>
    </div>
</x-filament::page>
