<div>
    <section>
        <div role="alert" class="alert alert-success bg-primary glass text-white text-base">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>
                Selamat Datang Di SiDAQ TPQ, anda masuk sebagai {{ auth()->user()->getRoleNames() }}
                cabang {{ auth()->user()->masjid->nama_masjid }}
            </span>
        </div>
    </section>
    <section class="w-full">
        <div class="h-fit bg-base-100 p-10 shadow-md glass rounded-md w-1/3 my-5">
            <h6 class="font-bold text-xl">Apa saja yang bisa anda lakukan ?</h6>
            <ul class="py-3 px-2 bg-base-100 shadow-md list-disc text-lg">
                <li>Manajemen Santri</li>
                <li>Manajemen Cabang {{ auth()->user()->masjid->nama_masjid }}</li>
                <li>Manajemen Akun</li>
            </ul>
        </div>
    </section>
</div>
