<div class="px-4 sm:px-10 min-h-screen">
    <div>
        <h3>Tambah Hafalan</h3>
        <div>
            <livewire:santri.hafalan.hafalan-create />
            <livewire:santri.hafalan.hafalan-edit />
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
</div>
