<div>
    @if ($aktif)
        <div class="flex justify-between items-center gap-x-9">
            <div class="border-l-8 border-accent px-4 py-4 bg-gray-700 w-full">
                <h1 class="text-xl text-slate-50 font-bold">Pilih Ustadz</h1>
            </div>
            {{-- <div>
            <input type="text" wire:model.debounce.50ms="search" wire:keyup="refreshSearch"
                class="border border-gray-300 px-3 py-1 mt-2 rounded-md" placeholder="Cari...">
        </div> --}}
        </div>
        <div class="p-4 bg-base-100 glass">
            <div class="join join-vertical">
                @foreach ($dataUstadz as $murobbi)
                    <a wire:click="pilihUstadz({{ $murobbi->id }})"
                        class="btn border border-primary join-item h-fit">{{ $murobbi->profile->nama_lengkap }}</a>
                @endforeach
            </div>
        </div>
    @endif
</div>
