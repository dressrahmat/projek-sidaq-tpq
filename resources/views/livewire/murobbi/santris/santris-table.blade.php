<div>
    <div>
        <h3 class="text-xl font-bold mb-4">Santri</h3>
    </div>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($dataSantri as $santri)
            <div class="card card-side bg-base-100 shadow-xl">
                <figure class="basis-1/3">
                    <img src="{{ asset('storage/' . $santri->photo_profile) }}" alt="Movie" class="h-full" />
                </figure>
                <div class="card-body basis-2/3">
                    <h2 class="card-title">{{ $santri->nama_lengkap }}</h2>
                    <p>{{ $santri->amanah }}</p>
                    <div class="card-actions justify-end">
                        <button @click="$dispatch('kemampuan', { id: '{{ $santri->user->id }}' })"
                            wire:key="{{ $santri->user->id }}" type="button"
                            class="btn btn-xs text-white btn-primary">Kemampuan</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
