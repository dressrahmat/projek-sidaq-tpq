<div>

    <x-dialog-modal wire:model.live="modalEdit" submit="edit">
        <x-slot name="title">
            Form Edit Hak Akses
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-2">

                <!-- Surah -->
                <div class="mb-1 col-span-6">
                    <x-label for="form.surat" value="Surat" />
                    <select name="" id=""
                        class="select select-primary select-bordered bg-gray-50 sm:w-full" wire:model="form.surat"
                        wire:change="changeSurat">
                        @foreach ($suratData as $surah)
                            <option @if ($form->surat == $surah['nomor']) selected @endif value="{{ $surah['nomor'] }}">
                                {{ $surah['namaLatin'] }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.surat" class="mt-1" />
                </div>

                <!-- Awal Ayat -->
                <div class="mb-1 col-span-3">
                    <x-label for="form.awal_ayat" value="Awal Ayat" />
                    <select name="" id="form.awal_ayat" class="select select-bordered bg-gray-50 w-20 sm:w-full"
                        wire:model="form.awal_ayat">
                        @if ($ayat)
                            @foreach ($ayat as $number)
                                <option @if ($form->awal_ayat == $number) selected @endif value="{{ $number }}">
                                    {{ $number }}</option>
                            @endforeach
                        @endif
                    </select>
                    <x-input-error for="form.awal_ayat" class="mt-1" />
                </div>

                <!-- Akhir Ayat -->
                <div class="mb-1 col-span-3">
                    <x-label for="form.akhir_ayat" value="Akhir Ayat" />
                    <select name="" id="form.akhir_ayat" class="select select-bordered bg-gray-50 w-20 sm:w-full"
                        wire:model="form.akhir_ayat">
                        @if ($ayat)
                            @foreach ($ayat as $number)
                                <option @if ($form->akhir_ayat == $number) selected @endif value="{{ $number }}">
                                    {{ $number }}</option>
                            @endforeach
                        @endif
                    </select>
                    <x-input-error for="form.akhir_ayat" class="mt-1" />
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
