<div class="flex flex-col lg:flex-row gap-4">
    <div class="basis-1/2">
        @livewire('admin.roles.roles-table')
    </div>
    <div class="basis-2/5">
        @livewire('admin.roles.roles-create')
        @livewire('admin.roles.roles-edit')
    </div>
    <div>
        <x-sweet-alert />
        <x-modal-sweet-alert />
        <x-confirm-delete />
    </div>
</div>
