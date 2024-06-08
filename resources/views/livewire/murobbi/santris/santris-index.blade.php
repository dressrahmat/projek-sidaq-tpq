<div class="flex flex-col lg:flex-row gap-4">
    <div>
        @livewire('murobbi.santris.santris-table')
    </div>
    <div>
        @livewire('murobbi.kemampuans.kemampuans-create')
    </div>
    <div>
        <x-sweet-alert />
        <x-modal-sweet-alert />
        <x-confirm-delete />
    </div>
</div>
