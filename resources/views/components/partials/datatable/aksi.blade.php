<div class="flex gap-1">
    <div class="tooltip" data-tip="Tambah akun">
        <button class="btn btn-primary rounded btn-sm text-base-100">
            <i class="fas fa-plus-square text-base"></i>
        </button>
    </div>
    <div class="tooltip" data-tip="Edit Akun">
        <x-button @click="$dispatch('form-edit', { id: '{{ $row->id }}' })" wire:key="{{ $row->id }}"
            type="button">
            <i class="fas fa-edit text-base"></i>
        </x-button>
    </div>
    <div class="tooltip" data-tip="Hapus">
        <x-danger-button @click="$dispatch('confirm-delete', { get_id: '{{ $row->id }}' })">
            <i class="fas fa-trash-alt text-base"></i>
        </x-danger-button>
    </div>

</div>
