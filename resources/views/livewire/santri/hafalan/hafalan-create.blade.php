<div>
    <form>
        <div>
            <input type="date" wire:model="tanggal_dibuat" wire:change="changeDate" class="input input-warning">
        </div>

        <div class="grid grid-cols-12 gap-2">

            <!-- Surah -->
            <div class="mb-1 col-span-6">
                <x-label for="form.surat" value="Surat" />
                <select name="" id="" class="select select-primary select-bordered bg-gray-50"
                    wire:model="form.surat" wire:change="changeSurat">
                    <option value="">-- Pilih Surah --</option>
                    @foreach ($suratData as $surah)
                        <option value="{{ $surah['nomor'] }}">{{ $surah['namaLatin'] }}</option>
                    @endforeach
                </select>
                <x-input-error for="form.surat" class="mt-1" />
            </div>

            <!-- Awal Ayat -->
            <div class="mb-1 col-span-3">
                <x-label for="form.awal_ayat" value="Awal Ayat" />
                <select name="" id="form.awal_ayat" class="select select-bordered bg-gray-50 w-20"
                    wire:model="form.awal_ayat">
                    <option value="">-</option>
                    @if ($ayat)
                        @foreach ($ayat as $number)
                            <option value="{{ $number }}">{{ $number }}</option>
                        @endforeach
                    @endif
                </select>
                <x-input-error for="form.awal_ayat" class="mt-1" />
            </div>

            <!-- Akhir Ayat -->
            <div class="mb-1 col-span-3">
                <x-label for="form.akhir_ayat" value="Akhir Ayat" />
                <select name="" id="form.akhir_ayat" class="select select-bordered bg-gray-50 w-20"
                    wire:model="form.akhir_ayat">
                    <option value="">-</option>
                    @if ($ayat)
                        @foreach ($ayat as $number)
                            <option value="{{ $number }}">{{ $number }}</option>
                        @endforeach
                    @endif
                </select>
                <x-input-error for="form.akhir_ayat" class="mt-1" />
            </div>

        </div>

        <!-- Submit Button -->
        <div class="flex flex-col gap-y-3 mt-2">
            <button wire:click.prevent="save()" class="btn btn-primary text-base-100 rounded-md">Tambah</button>
        </div>
    </form>
</div>
