<div class="flex flex-col lg:flex-row gap-4">
    <div class="basis-3/5">
        @livewire('admin.masjids.masjids-table')
    </div>
    <div class="basis-2/5">
        @livewire('admin.masjids.masjids-create')
        @livewire('admin.masjids.masjids-edit')
    </div>
    <div>
        <x-sweet-alert />
        <x-modal-sweet-alert />
        <x-confirm-delete />
    </div>
</div>
