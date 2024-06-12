<div class="mt-5">
    <h3 class="font-bold mb-4">Hafalan Saya</h3>
    <div class="join">
        <button class="btn btn-xs join-item @if ($filter == 'Belum Disetorkan') bg-accent @endif"
            wire:click="setFilter('Belum Disetorkan')">Belum Disetorkan</button>
        <button class="btn btn-xs join-item @if ($filter == 'Sudah Disetorkan') bg-accent @endif"
            wire:click="setFilter('Sudah Disetorkan')">Sudah Disetorkan</button>
        <button class="btn btn-xs join-item @if ($filter == 'Surat Selesai') bg-accent @endif"
            wire:click="setFilter('Surat Selesai')">Surat Selesai</button>
    </div>

    <div>
        <table class="table text-base">
            <!-- head -->
            <thead class="sm:text-base">
                <tr>
                    <th>No</th>
                    <th>Surah</th>
                    <th>Awal Ayat</th>
                    <th>Akhir Ayat</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $hafalan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hafalan->surat }}</td>
                        <td>{{ $hafalan->awal_ayat }}</td>
                        <td>{{ $hafalan->akhir_ayat }}</td>
                        @if ($hafalan->keterangan != 'lanjut')
                            <td>
                                <x-button @click="$dispatch('form-edit', { id: '{{ $hafalan->id }}' })"
                                    wire:key="{{ $hafalan->id }}" type="button">
                                    <i class="fas fa-edit text-base"></i>
                                </x-button>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
