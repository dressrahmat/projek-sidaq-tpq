<div>
    <div class="card bg-gray-200 shadow-xl">
        <div class="flex justify-between items-center gap-x-9">
            <div class="border-l-8 border-accent px-4 py-4 bg-gray-700 w-full">
                <h1 class="text-xl text-slate-50 font-bold">Tambah Hak Akses</h1>
            </div>
            {{-- <div>
            <input type="text" wire:model.debounce.50ms="search" wire:keyup="refreshSearch"
                class="border border-gray-300 px-3 py-1 mt-2 rounded-md" placeholder="Cari...">
        </div> --}}
        </div>
        <div class="card-body pt-3">
            <form>
                <!-- Nama Permission -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text py-2">Nama Hak Akses</span>
                        <input type="text" wire:model="form.name" placeholder="Masukkan Hak Akses"
                            class="input input-primary bg-gray-100 rounded-md  @error('form.name') border-red-500 @enderror"
                            autofocus />
                        @error('form.name')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-y-3 mt-2">
                    <button wire:click.prevent="save()" class="btn btn-primary text-base-100 rounded-md">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
