<x-filament::page>
    <div class="max-w-5xl mx-auto">
        <div class="mb-6 rounded-lg border border-warning-300 bg-warning-50 p-4 text-sm text-warning-900">
            SMTP credentials are stored encrypted. Saved passwords are never shown. Use the test email action to verify the connection before approving access requests.
        </div>

        {{ $this->form }}

        <div class="flex flex-wrap justify-end gap-3 mt-6">
            <x-filament::button color="gray" wire:click="sendTestEmail" wire:loading.attr="disabled">
                Send test email
            </x-filament::button>
            <x-filament::button wire:click="save" wire:loading.attr="disabled">
                Save mail settings
            </x-filament::button>
        </div>
    </div>
</x-filament::page>