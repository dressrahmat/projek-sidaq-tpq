<div>

    <x-dialog-modal wire:model.live="modalHafalan" submit="save">
        <x-slot name="title">
            Hafalan {{ $nama_santri }}
        </x-slot>

        <x-slot name="content">
            <div>
                <input type="date" wire:model="tanggal_dibuat" wire:change="changeDate" class="input input-warning">
            </div>
            <div class="grid grid-cols-12 gap-4">

                <!-- Surah -->
                <div class="mb-1 col-span-4">
                    <x-label for="form.khidmat" value="Surah" />
                    <x-input id="form.khidmat" type="text" class="mt-1 w-full" wire:model="form.khidmat" require
                        autocomplete="form.khidmat" />
                    <x-input-error for="form.khidmat" class="mt-1" />
                </div>

                <!-- Awal Ayat -->
                <div class="mb-1 col-span-2">
                    <x-label for="form.entrepreneur" value="Awal Ayat" />
                    <x-input id="form.entrepreneur" type="text" class="mt-1 w-full" wire:model="form.entrepreneur"
                        require autocomplete="form.entrepreneur" />
                    <x-input-error for="form.entrepreneur" class="mt-1" />
                </div>

                <!-- Akhir Ayat -->
                <div class="mb-1 col-span-2">
                    <x-label for="form.operation" value="Akhir Ayat" />
                    <x-input id="form.operation" type="text" class="mt-1 w-full" wire:model="form.operation" require
                        autocomplete="form.operation" />
                    <x-input-error for="form.operation" class="mt-1" />
                </div>

                <!-- Keterangan -->
                <div class="mb-1 col-span-2">
                    <x-label for="form.administration" value="Keterangan" />
                    <x-input id="form.administration" type="text" class="mt-1 w-full"
                        wire:model="form.administration" require autocomplete="form.administration" />
                    <x-input-error for="form.administration" class="mt-1" />
                </div>

                <!-- Status -->
                <div class="mb-1 col-span-2">
                    <x-label for="form.administration" value="Status" />
                    <x-input id="form.administration" type="text" class="mt-1 w-full"
                        wire:model="form.administration" require autocomplete="form.administration" />
                    <x-input-error for="form.administration" class="mt-1" />
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('modalHafalan', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled">
                Simpan
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
