<div>
    <form>
        <div class="grid grid-cols-12 gap-4">

            <!-- Surah -->
            <div class="mb-1 col-span-6">
                <x-label for="form.khidmat" value="Surah" />
                <x-input id="form.khidmat" type="text" class="mt-1 w-full" wire:model="form.khidmat" require
                    autocomplete="form.khidmat" />
                <x-input-error for="form.khidmat" class="mt-1" />
            </div>

            <!-- Awal Ayat -->
            <div class="mb-1 col-span-3">
                <x-label for="form.entrepreneur" value="Awal Ayat" />
                <x-input id="form.entrepreneur" type="text" class="mt-1 w-full" wire:model="form.entrepreneur"
                    require autocomplete="form.entrepreneur" />
                <x-input-error for="form.entrepreneur" class="mt-1" />
            </div>

            <!-- Akhir Ayat -->
            <div class="mb-1 col-span-3">
                <x-label for="form.operation" value="Akhir Ayat" />
                <x-input id="form.operation" type="text" class="mt-1 w-full" wire:model="form.operation" require
                    autocomplete="form.operation" />
                <x-input-error for="form.operation" class="mt-1" />
            </div>

        </div>

        <!-- Submit Button -->
        <div class="flex flex-col gap-y-3 mt-2">
            <button wire:click.prevent="save()" class="btn btn-primary text-base-100 rounded-md">Tambah</button>
        </div>
    </form>
</div>
