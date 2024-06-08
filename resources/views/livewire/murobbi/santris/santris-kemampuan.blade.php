<div>

    <x-dialog-modal wire:model.live="modalKemampuan" submit="save">
        <x-slot name="title">
            Kemampuan {{ $nama_santri }}
        </x-slot>

        <x-slot name="content">
            <div>
                <input type="date" wire:model="tanggal_dibuat" wire:change="changeDate" class="input input-warning">
            </div>
            <div class="grid grid-cols-2 gap-4">

                <!-- Khidmat -->
                <div class="mb-1">
                    <x-label for="form.khidmat" value="Khidmat" />
                    <x-input id="form.khidmat" type="text" class="mt-1 w-full" wire:model="form.khidmat" require
                        autocomplete="form.khidmat" />
                    <x-input-error for="form.khidmat" class="mt-1" />
                </div>

                <!-- Entrepreneur -->
                <div class="mb-1">
                    <x-label for="form.entrepreneur" value="Entrepreneur" />
                    <x-input id="form.entrepreneur" type="text" class="mt-1 w-full" wire:model="form.entrepreneur"
                        require autocomplete="form.entrepreneur" />
                    <x-input-error for="form.entrepreneur" class="mt-1" />
                </div>

                <!-- Operation -->
                <div class="mb-1">
                    <x-label for="form.operation" value="Operation" />
                    <x-input id="form.operation" type="text" class="mt-1 w-full" wire:model="form.operation" require
                        autocomplete="form.operation" />
                    <x-input-error for="form.operation" class="mt-1" />
                </div>

                <!-- Administration -->
                <div class="mb-1">
                    <x-label for="form.administration" value="Administration" />
                    <x-input id="form.administration" type="text" class="mt-1 w-full"
                        wire:model="form.administration" require autocomplete="form.administration" />
                    <x-input-error for="form.administration" class="mt-1" />
                </div>

                <!-- Leadership -->
                <div class="mb-1">
                    <x-label for="form.leadership" value="Leadership" />
                    <x-input id="form.leadership" type="text" class="mt-1 w-full" wire:model="form.leadership"
                        require autocomplete="form.leadership" />
                    <x-input-error for="form.leadership" class="mt-1" />
                </div>

                <!-- Speaking -->
                <div class="mb-1">
                    <x-label for="form.speaking" value="Speaking" />
                    <x-input id="form.speaking" type="text" class="mt-1 w-full" wire:model="form.speaking" require
                        autocomplete="form.speaking" />
                    <x-input-error for="form.speaking" class="mt-1" />
                </div>

                <!-- Menagajar -->
                <div class="mb-1">
                    <x-label for="form.mengajar" value="Menagajar" />
                    <x-input id="form.mengajar" type="text" class="mt-1 w-full" wire:model="form.mengajar" require
                        autocomplete="form.mengajar" />
                    <x-input-error for="form.mengajar" class="mt-1" />
                </div>


            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('modalKemampuan', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled">
                Simpan
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
