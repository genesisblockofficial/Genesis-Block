<x-filament::page>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 rounded-lg border border-warning-300 bg-warning-50 p-4 text-sm text-warning-900">
            Never share Google client secrets in chat or commit them to Git. Saved secrets are encrypted and are not loaded back into this form.
        </div>

        {{ $this->form }}

        <div class="mt-6 rounded-lg border border-gray-200 p-4 text-sm">
            <p class="font-semibold">Authorized redirect URI</p>
            <p class="mt-1">Add this exact URL to Authorized redirect URIs in Google Cloud Console:</p>
            <code class="mt-2 block break-all">{{ route('auth.google.callback') }}</code>
        </div>

        <div class="flex justify-end mt-6">
            <x-filament::button wire:click="save" wire:loading.attr="disabled">
                Save Google sign-in settings
            </x-filament::button>
        </div>
    </div>
</x-filament::page>