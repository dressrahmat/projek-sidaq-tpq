<div class="flex flex-col lg:flex-row gap-4">
    <div class="basis-1/2 card bg-gray-200 shadow-xl">
        <div class="border-l-8 border-accent px-4 py-4 bg-gray-700 w-full">
            <h1 class="text-xl text-slate-50 font-bold">Data Profile</h1>
        </div>
        <div class="card-body py-3">
            @livewire('admin.profile.profile-table')
        </div>
    </div>

    <div class="basis-2/5">
        {{-- @livewire('admin.profile.profile-create') --}}
        @livewire('admin.profile.profile-edit')
    </div>
    <!-- Sweet Alert -->
    <div>
        <x-sweet-alert />
        <x-modal-sweet-alert />
        <x-confirm-delete />
    </div>
</div>
