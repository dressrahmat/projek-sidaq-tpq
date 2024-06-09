<div class="mt-5">
    <h3 class="font-bold mb-4">Hafalan Saya</h3>
    <div>
        <table class="table text-base">
            <!-- head -->
            <thead class="text-base">
                <tr>
                    <th>No</th>
                    <th>Surah</th>
                    <th>Awal Ayat</th>
                    <th>Akhir Ayat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $permission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->surat }}</td>
                        <td>{{ $permission->awal_ayat }}</td>
                        <td>{{ $permission->akhir_ayat }}</td>
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
