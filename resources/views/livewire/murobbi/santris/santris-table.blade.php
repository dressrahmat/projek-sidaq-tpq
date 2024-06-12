<div>
    <div class="mb-4 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold mb-4">Santri</h3>
        </div>
    </div>
    <div class="grid sm:grid-cols-3 gap-4">
        @foreach ($dataSantri as $santri)
            <div class="card card-side bg-base-100 shadow-xl">
                <figure class="basis-1/3">
                    <img src="{{ asset('storage/' . $santri->photo_profile) }}" alt="Movie" class="h-full" />
                </figure>
                <div class="card-body basis-2/3 justify-between mb-2">
                    <h2 class="card-title h-10">{{ $santri->nama_lengkap }}</h2>
                    <div class="text-base-content">
                        @foreach ($santri->user->kemampuan_user()->whereDate('kemampuan_user.created_at', Carbon\Carbon::today())->latest()->limit(1)->get() as $kemampuan)
                            <div class="flex justify-between mb-2">
                                <p>Total Nilai Terakhir : <span
                                        class="font-bold">{{ $kemampuan->pivot->total_nilai }}</span></p>
                                <p>
                                    {{ \Carbon\Carbon::parse($kemampuan->pivot->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </p>
                            </div>
                        @endforeach
                        @foreach ($santri->user->hafalan_user()->where('keterangan', 'lanjut')->whereDate('hafalan_user.created_at', Carbon\Carbon::today())->latest()->limit(1)->get() as $hafalan)
                            <div class="flex justify-between">
                                <p>Setoran Terakhir : <span class="font-bold">{{ $hafalan->surat }} :
                                        {{ $hafalan->awal_ayat }} - {{ $hafalan->akhir_ayat }}</span>
                                </p>
                                <p>
                                    {{ \Carbon\Carbon::parse($hafalan->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-actions justify-end">
                        <button @click="$dispatch('kemampuan', { data: '{{ $santri->user->id }}' })"
                            wire:key="{{ $santri->user->id }}" type="button"
                            class="btn btn-sm btn-block rounded-md text-white btn-primary">
                            Kemampuan
                        </button>

                        <button @click="$dispatch('hafalan', { data: '{{ $santri->user->id }}' })"
                            wire:key="{{ $santri->user->id }}" type="button"
                            class="btn btn-sm btn-block rounded-md text-white btn-warning">
                            Hafalan
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
