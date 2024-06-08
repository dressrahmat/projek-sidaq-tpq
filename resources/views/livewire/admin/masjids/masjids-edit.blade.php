<div>

    <x-dialog-modal wire:model.live="modalEdit" submit="edit">
        <x-slot name="title">
            Form Edit Masjid
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-2 gap-4">

                <!-- Photo Kategori -->
                <div class="mb-2 ">
                    <label class="form-control">
                        <span class="label-text text-base-content mb-2">Upload Photo Masjid</span>
                        <div class="relative mb-2">
                            <label for="photo_masjid" class="cursor-pointer flex items-center justify-center">
                                <div class="shadow-lg w-full h-[350px] rounded-lg flex items-center justify-center bg-cover bg-center"
                                    style="background-image: url('{{ !$form->photo_masjid ? asset('assets/images/website/add-image.png') : (is_string($form->photo_masjid) ? 'storage/' . $form->photo_masjid : $form->photo_masjid->temporaryUrl()) }}');">
                                    @if (!$form->photo_masjid || !is_object($form->photo_masjid) || !$form->photo_masjid instanceof UploadedFile)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    @endif
                                </div>
                            </label>
                            <input admin="file" id="photo_masjid" wire:model="form.photo_masjid" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                    </label>
                    @error('form.photo_masjid')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <!-- Masjid -->
                    <div class=" mb-4">
                        <x-label for="form.nama_masjid" value="Edit Masjid" />
                        <x-input id="form.nama_masjid" type="text" class="mt-1 w-full" wire:model="form.nama_masjid"
                            require autocomplete="form.nama_masjid" />
                        <x-input-error for="form.nama_masjid" class="mt-1" />
                    </div>

                    <!-- Admin -->
                    <div class="mb-4" x-data="{ id: $id('input-text') }">
                        <x-label ::for="id" value="Admin" />
                        <x-tom x-init="$el.admin = new Tom($el, {
                            sortField: {
                                field: 'name',
                                direction: 'asc',
                            },
                            valueField: 'id',
                            labelField: 'name',
                            searchField: 'name',
                            load: function(query, callback) {
                                $wire.getUser(query).then(results => {
                                    callback(results);
                                }).catch(() => {
                                    callback();
                                })
                            },
                            render: {
                                option: function(item, escape) {
                                    return `<div>${escape(item.name)}</div>`
                                },
                                option: function(item, escape) {
                                    return `<div>${escape(item.name)}</div>`
                                }
                            }
                        });"
                            @set-admin.window="
                                $el.admin.clear();
                                $el.admin.clearOptions();
                                $el.admin.addOption(event.detail.data);
                                $el.admin.addItem(event.detail.id);
                                console.log(event.detail.data)
                        "
                            ::id="id" type="text" class="mt-1 w-full" wire:model="form.admin" require
                            autocomplete="admin-edit">
                            <option></option>
                        </x-tom>
                        <x-input-error for="form.admin" class="mt-1" />
                    </div>

                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('modalEdit', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled">
                Simpan
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
