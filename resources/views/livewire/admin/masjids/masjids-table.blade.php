<div class="card bg-gray-200 shadow-xl">
    <div class="flex justify-between items-center gap-x-9">
        <div class="border-l-8 border-accent px-4 py-4 bg-gray-700 w-full">
            <h1 class="text-xl text-slate-50 font-bold">Data Masjid</h1>
        </div>
        {{-- <div>
            <input type="text" wire:model.debounce.50ms="search" wire:keyup="refreshSearch"
                class="border border-gray-300 px-3 py-1 mt-2 rounded-md" placeholder="Cari...">
        </div> --}}
    </div>
    <div class="card-body">
        <table class="table text-base border-separate border-spacing-y-1">
            <!-- head -->
            <thead class="text-lg">
                <tr>
                    <th>No</th>
                    <th>Photo</th>
                    <th>Masjid</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $masjid)
                    <tr class="shadow-md">
                        <td class="border border-slate-600 rounded-l-md">{{ $data->firstItem() + $loop->index }}</td>
                        <td class="border border-slate-600 flex justify-center">
                            <img src="{{ asset('storage/' . $masjid->photo_masjid) }}" alt="" class="w-20">
                        </td>
                        <td class="border border-slate-600">{{ $masjid->nama_masjid }}</td>
                        <td class="border border-slate-600  rounded-r-md">
                            <!-- Dropdown -->
                            <div class="dropdown">
                                <div tabindex="0" role="button" class="btn btn-xs rounded-md btn-neutral m-1"><i
                                        class="fas fa-eye"></i></div>
                                <ul tabindex="0"
                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-300 rounded-md w-fit">
                                    <li class="my-1">
                                        <a wire:navigate href="{{ route('masjids.show', $masjid->id) }}"
                                            class="btn btn-sm rounded-md btn-info">
                                            <i class="fas fa-expand text-base text-white"></i>
                                        </a>
                                    </li>

                                    <li class="my-1">
                                        <x-button @click="$dispatch('form-edit', { id: '{{ $masjid->id }}' })"
                                            wire:key="{{ $masjid->id }}" type="button">
                                            <i class="fas fa-edit text-base"></i>
                                        </x-button>
                                    </li>

                                    <li class="my-1">
                                        <x-danger-button
                                            @click="$dispatch('confirm-delete', { get_id: '{{ $masjid->id }}' })">
                                            <i class="fas fa-trash-alt text-base"></i>
                                        </x-danger-button>
                                    </li>
                                </ul>
                            </div>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="my-5">
            {{ $data->onEachSide(1)->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
