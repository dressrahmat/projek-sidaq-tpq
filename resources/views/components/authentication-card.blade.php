<div class="flex bg-base-100 w-full h-screen justify-center items-center gap-10">
    <div class="relative h-full w-full flex justify-center items-center object-contain"
        style="background-image: url('{{ asset('assets/images/website/backdrop-1.png') }}');">
        <div
            class="absolute inset-0 bg-gradient-to-br from-green-500 via-green-200 to-purple-500 bg-opacity-70 opacity-90">
        </div>
        <div class="relative w-1/2">
            <h3 class="mix-blend-difference text-5xl font-bold text-white mb-1">Selamat Datang</h3>
            <h4 class="mix-blend-difference text-6xl font-bold text-white mb-1">DI SIDAQ TPQ</h4>
            <p class="mix-blend-difference font-medium text-white text-base">
                SiDAQ adalah gerakan nasional memberantas buta huruf Al Qur’an, mencetak 23 juta penghafal Al Qur’an dan
                membangun 6.236 Rumah/Pondok Qur’an di 114 kawasan untuk mensurgakan Indonesia
            </p>

        </div>
    </div>
    <div class="basis-2/3 px-5">
        <div class="card bg-base-100 glass h-fit ">
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
