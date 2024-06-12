<div class="px-2 sm:px-10 pb-10 pt-20 min-h-screen">
    <div class="flex flex-col sm:flex-row gap-x-8">
        <div class="w-full bg-base-100 p-4 rounded-md shadow-md">
            <h3 class="font-bold text-2xl">Tambah Hafalan </h3>
            <div>
                <livewire:santri.hafalan.hafalan-create />
                <livewire:santri.hafalan.hafalan-edit />
                <livewire:admin.profile.profile-edit />
            </div>
            <div>
                <livewire:santri.hafalan.hafalan-table />
            </div>
        </div>
        <div>
            <x-sweet-alert />
            <x-modal-sweet-alert />
            <x-confirm-delete />
        </div>
        <div class="w-full hidden sm:block">
            @livewire('santri.profile.profile-show')
        </div>
    </div>
</div>
