<div>

    <x-dialog-modal wire:model.live="modalHafalan">
        <x-slot name="title">
            Hafalan {{ $nama_santri }}
        </x-slot>

        <x-slot name="content">
            <div>
                <input type="date" wire:model="tanggal_dibuat" wire:change="changeDate" class="input input-warning">
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Surah</th>
                            <th>Awal Ayat</th>
                            <th>Akhir Ayat</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($hafalan)
                            @foreach ($hafalan as $setoran)
                                <tr>
                                    <!-- Surah -->
                                    <td class="mb-1 col-span-6">
                                        <p>{{ $setoran->surat }}</p>
                                    </td>

                                    <!-- Awal Ayat -->
                                    <td class="mb-1 col-span-2">
                                        <p>{{ $setoran->awal_ayat }}</p>
                                    </td>

                                    <!-- Akhir Ayat -->
                                    <td class="mb-1 col-span-2">
                                        <p>{{ $setoran->akhir_ayat }}</p>
                                    </td>

                                    <!-- Keterangan -->
                                    <td class="mb-1 col-span-2">
                                        <select id="keterangan.{{ $setoran->id }}"
                                            wire:model="keterangan.{{ $setoran->id }}"
                                            wire:change="changeKeterangan({{ $setoran->id }})"
                                            class="select select-primary w-full max-w-xs">
                                            <option value="" selected>Keterangan</option>
                                            <option value="lanjut">Lanjut</option>
                                            <option value="ulang">Ulang</option>
                                        </select>
                                    </td>

                                    <!-- Status -->
                                    <td class="mb-1 col-span-2">
                                        <div class="form-control">
                                            <label class="label cursor-pointer gap-x-2">
                                                <input type="checkbox" id="status.{{ $setoran->id }}"
                                                    wire:model="status.{{ $setoran->id }}"
                                                    wire:change="changeStatus({{ $setoran->id }})"
                                                    @if ($setoran->status !== null) checked="checked" @endif
                                                    class="checkbox" />
                                                <span class="label-text">Checklis surah jika sudah selesai</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('modalHafalan', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            {{-- <x-button class="ms-3" wire:loading.attr="disabled">
                Simpan
            </x-button> --}}
        </x-slot>
    </x-dialog-modal>
</div>
