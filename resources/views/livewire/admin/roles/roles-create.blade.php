<div>
    <div class="card bg-gray-200 shadow-xl">
        <div class="flex justify-between items-center gap-x-9">
            <div class="border-l-8 border-accent px-4 py-4 bg-gray-700 w-full">
                <h1 class="text-xl text-slate-50 font-bold">Tambah Jabatan</h1>
            </div>
            {{-- <div>
            <input type="text" wire:model.debounce.50ms="search" wire:keyup="refreshSearch"
                class="border border-gray-300 px-3 py-1 mt-2 rounded-md" placeholder="Cari...">
        </div> --}}
        </div>
        <div class="card-body pt-3">
            <form>
                <!-- Nama Jabatan -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text py-2">Nama Jabatan</span>
                        <input type="text" wire:model="form.name" placeholder="Masukkan Jabatan"
                            class="input input-primary bg-gray-100 rounded-md  @error('form.name') border-red-500 @enderror"
                            autofocus />
                        @error('form.name')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <!-- Nama Hak Akses -->
                <div class="mb-2">
                    <x-label for="form.permissions" value="Hak Akses" />
                    <x-tom x-init="$el.permissions = new Tom($el, {
                        sortField: {
                            field: 'permissions',
                            direction: 'asc',
                        },
                        valueField: 'permissions',
                        labelField: 'permissions',
                        searchField: 'permissions',
                    });" @set-reset.window="$el.permissions.clear()" id="form.permissions"
                        type="text" class="mt-1 w-full" multiple wire:model="form.permissions">
                        <option></option>
                        @foreach ($permissions as $permission)
                            <option>{{ $permission->name }}</option>
                        @endforeach
                    </x-tom>
                    <x-input-error for="form.permissions" class="mt-1" />
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-y-3 mt-2">
                    <button wire:click.prevent="save()" class="btn btn-primary text-base-100 rounded-md">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
