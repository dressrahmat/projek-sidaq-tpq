<div>
    <div class="flex gap-10 p-5 bg-base-content glass text-base-100 rounded-md shadow-md mb-10">
        <div class="w-1/4 rounded-md overflow-hidden">
            <img src="{{ asset('storage/' . $masjid->photo_masjid) }}" alt="">
        </div>
        <div>
            <h1 class="text-3xl font-bold">{{ $masjid->nama_masjid }}</h1>
        </div>
    </div>
    <div>
        <h3 class="text-xl font-bold mb-4">
            Ustadz
        </h3>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            @foreach ($dataUstadz as $ustadz)
                <div>
                    <div class="card bg-base-100 shadow-xl mb-4">
                        <div class="card-body">
                            <h2 class="card-title">{{ $ustadz->name }}</h2>
                            <p>{{ $ustadz->email }}</p>
                            <p>{{ $ustadz->phone }}</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-4">
                        Santri
                    </h3>
                </div>
            @endforeach
        </div>
    </div>
</div>
