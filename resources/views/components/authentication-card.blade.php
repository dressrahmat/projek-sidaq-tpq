<div class="flex bg-base-100 flex-col sm:justify-center items-center pt-28 pb-28">
    <div class="hero">
        <div class="hero-content w-2/5 flex-col lg:flex-row-reverse">
            <div class="card shrink-0 w-full shadow-2xl bg-base-100 text-base-content">
                <div class="flex flex-col sm:justify-center items-center sm:pt-0">
                    <div class="w-full px-6 py-8 bg-base-200 shadow-md overflow-hidden sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
