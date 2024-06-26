<div>
    <div class="card bg-gray-200 shadow-xl">
        <div class="flex justify-between items-center gap-x-9">
            <div class="border-l-8 border-accent px-4 py-4 bg-gray-700 w-full">
                <h1 class="text-xl text-slate-50 font-bold">Tambah Profile</h1>
            </div>
            {{-- <div>
            <input type="text" wire:model.debounce.50ms="search" wire:keyup="refreshSearch"
                class="border border-gray-300 px-3 py-1 mt-2 rounded-md" placeholder="Cari...">
        </div> --}}
        </div>
        <div class="card-body pt-3">
            <form>
                <!-- Nama -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text py-2">Nama</span>
                        <input type="text" wire:model="form.name" placeholder="Masukkan nama Profile"
                            class="input input-primary bg-gray-100 rounded-md  @error('form.name') border-red-500 @enderror"
                            autofocus />
                        @error('form.name')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <!-- Email -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text py-2">Email</span>
                        <input type="email" wire:model="form.email" placeholder="Masukkan email"
                            class="input input-primary bg-gray-100 rounded-md  @error('form.email') border-red-500 @enderror"
                            autofocus />
                        @error('form.email')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text py-2">Password</span>
                        <input type="password" wire:model="form.password" placeholder="Masukkan password"
                            class="input input-primary bg-gray-100 rounded-md  @error('form.password') border-red-500 @enderror"
                            autofocus />
                        @error('form.password')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <!-- Nama Jabatan -->
                <div class="mb-2">
                    <x-label for="form.masjids" value="Jabatan" />
                    <x-tom x-init="$el.masjids = new Tom($el, {
                        sortField: {
                            field: 'roles',
                            direction: 'asc',
                        },
                        valueField: 'roles',
                        labelField: 'roles',
                        searchField: 'roles',
                    });" @set-reset.window="$el.roles.clear()" id="form.roles" type="text"
                        class="mt-1 w-full" multiple wire:model="form.roles">
                        <option></option>
                        @foreach ($role as $jabatan)
                            <option>{{ $jabatan->name }}</option>
                        @endforeach
                    </x-tom>
                    <x-input-error for="form.permissions" class="mt-1" />
                </div>

                <!-- Nama Masjid -->
                <div class="col-span-12 mb-4">
                    <x-label for="masjid-create" value="Masjid" />
                    <x-tom x-init="$el.masjid = new Tom($el, {
                        sortField: {
                            field: 'nama_masjid',
                            direction: 'asc',
                        },
                        valueField: 'id',
                        labelField: 'nama_masjid',
                        searchField: 'nama_masjid',
                        load: function(query, callback) {
                            $wire.getMasjid(query).then(results => {
                                callback(results);
                            }).catch(() => {
                                callback();
                            })
                        },
                        render: {
                            option: function(item, escape) {
                                return `<div>${escape(item.nama_masjid)}</div>`
                            },
                            option: function(item, escape) {
                                return `<div>${escape(item.nama_masjid)}</div>`
                            }
                        }
                    });"
                        @set-masjid-create.window="
                            $el.masjid.addOption(event.detail.data)
                        "
                        @set-reset.window="$el.masjid.clear()" id="masjid-create" type="text" class="mt-1 w-full"
                        wire:model="form.masjid" require autocomplete="masjid-create">
                        <option value=""></option>
                    </x-tom>
                    <x-input-error for="form.masjid" class="mt-1" />
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-y-3 mt-2">
                    <button wire:click.prevent="save()" class="btn btn-primary text-base-100 rounded-md">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
