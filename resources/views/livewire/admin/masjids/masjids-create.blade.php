<div>
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
            <form>

                <!-- Photo Kategori -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text text-base-content mb-2">Upload Photo Masjid</span>
                        <div class="relative mb-2">
                            <!-- Label yang menutupi seluruh div -->
                            <label for="photo_masjid" class="cursor-pointer flex items-center justify-center">
                                <!-- Background untuk gambar yang diunggah -->
                                <div class="shadow-lg w-full h-[400px] rounded-lg flex items-center justify-center bg-cover bg-center"
                                    style="background-image: url('{{ $form->photo_masjid != null ? $form->photo_masjid->temporaryUrl() : asset('assets/images/website/add-image-persegi.png') }}');">
                                    <!-- Icon untuk memilih gambar -->
                                    @if (!$form->photo_masjid)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    @endif
                                </div>
                            </label>
                            <!-- Input file yang disembunyikan tapi menutupi seluruh div -->
                            <input type="file" id="photo_masjid" wire:model="form.photo_masjid" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                    </label>
                    @error('form.photo_masjid')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nama Masjid -->
                <div class="mb-2">
                    <label class="form-control">
                        <span class="label-text py-2">Nama Masjid</span>
                        <input type="text" wire:model="form.nama_masjid" placeholder="Masukkan Masjid"
                            class="input input-primary bg-gray-100 rounded-md  @error('form.nama_masjid') border-red-500 @enderror"
                            autofocus />
                        @error('form.nama_masjid')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-y-3 mt-2">
                    <button wire:click.prevent="save()" class="btn btn-primary text-base-100 rounded-md">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
