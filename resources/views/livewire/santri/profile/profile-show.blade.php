<div class="card card-side bg-base-100 shadow-md flex gap-x-4 sm:gap-x-8 w-full">
    <div class="basis-2/5">
        <img src="{{ asset('storage/' . $data->photo_profile) }}" alt="" class="w-full h-96 object-contain">
    </div>
    <div class="basis-3/5 card-body">
        <h3 class="font-bold mb-2 sm:text-4xl">{{ $data->nama_lengkap }}</h3>
        <div class="text-sm sm:text-base">
            <p class="mb-2">Email : {{ $data->user->email }}</p>
            <p class="mb-2">Jenis kelamin : {{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            <p class="mb-2">Tanggal lahir :
                {{ \Carbon\Carbon::parse($data->tanggal_lahir)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </p>
            <p class="mb-2">Provinsi : {{ $data->provinsi }}</p>
            <p class="mb-2">Kabupaten : {{ $data->kabupaten }}</p>
            <p class="mb-2">Alamat : {{ $data->alamat }}</p>
        </div>
    </div>
    <div>
        <button class="btn btn-primary text-white" @click="$dispatch('edit-profile', { id: '{{ $data->id }}' })"
            wire:key="{{ $data->id }}" type="button">Edit</button>
    </div>
</div>
