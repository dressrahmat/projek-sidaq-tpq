<div class="flex flex-col lg:flex-row gap-4">
    <div class="basis-1/2">
        @livewire('admin.permissions.permissions-table')
    </div>
    <div class="basis-2/5">
        @livewire('admin.permissions.permissions-create')
        @livewire('admin.permissions.permissions-edit')
    </div>
    <div>
        <x-sweet-alert />
        <x-modal-sweet-alert />
        <x-confirm-delete />
    </div>
</div>
