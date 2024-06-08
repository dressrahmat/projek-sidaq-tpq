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
                <div class="card-body basis-2/3 justify-between">
                    <h2 class="card-title h-10">{{ $santri->nama_lengkap }}</h2>
                    @foreach ($santri->user->kemampuan_user()->whereDate('kemampuan_user.created_at', Carbon\Carbon::today())->get() as $kemampuan)
                        <div class="flex justify-between">
                            <p>Total Nilai Terakhir : <span
                                    class="font-bold">{{ $kemampuan->pivot->total_nilai }}</span></p>
                            <p>
                                {{ \Carbon\Carbon::parse($kemampuan->pivot->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                            </p>
                        </div>
                    @endforeach
                    <div class="card-actions flex-col justify-end">
                        <button @click="$dispatch('kemampuan', { data: '{{ $santri->user->id }}' })"
                            wire:key="{{ $santri->user->id }}" type="button" class="btn btn-xs text-white btn-primary">
                            Kemampuan
                        </button>

                        <button @click="$dispatch('hafalan', { data: '{{ $santri->user->id }}' })"
                            wire:key="{{ $santri->user->id }}" type="button" class="btn btn-xs text-white btn-warning">
                            Hafalan
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
