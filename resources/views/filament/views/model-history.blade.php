<x-filament::page>
    <x-filament::form wire:submit="save">
        {{ $this->form }}

        <x-filament::form.actions :form="$this->form" />
    </x-filament::form>

    {{-- Your audit log below the form --}}
    @include('components.model-history', ['record' => $this->record])
</x-filament::page>
