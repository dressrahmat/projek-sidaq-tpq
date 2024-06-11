<div>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <div>
            <h3 class="font-semibold">Silahkan Masukkan Data Anda Untuk Kami Proses...</h3>
        </div>

        <x-validation-errors class="mb-4" />

        <form>
            <div class="grid grid-cols-2 gap-3">
                <!-- Photo Profile -->
                <div class="mb-1">
                    <label class="form-control">
                        <span class="label-text text-base-content mb-1">Upload Photo Profile</span>
                        <div class="relative mb-1">
                            <!-- Label yang menutupi seluruh div -->
                            <label for="photo_profile" class="cursor-pointer flex items-center justify-center">
                                <!-- Background untuk gambar yang diunggah -->
                                <div class="shadow-lg w-full h-[250px] rounded-lg flex items-center justify-center bg-cover bg-center"
                                    style="background-image: url('{{ $form->photo_profile != null ? $form->photo_profile->temporaryUrl() : asset('assets/images/website/add-image-persegi.png') }}');">
                                    <!-- Icon untuk memilih gambar -->
                                    @if (!$form->photo_profile)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    @endif
                                </div>
                            </label>
                            <!-- Input file yang disembunyikan tapi menutupi seluruh div -->
                            <input type="file" id="photo_profile" wire:model="form.photo_profile" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                    </label>
                    @error('form.photo_profile')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <!-- Nama Lengkap -->
                    <div class="mb-1">
                        <label class="form-control">
                            <span class="label-text py-2">Nama Lengkap</span>
                            <input type="text" wire:model="form.nama_lengkap" placeholder="Masukkan Nama Lengkap"
                                class="input input-primary bg-gray-100 rounded-md  @error('form.nama_lengkap') border-red-500 @enderror"
                                autofocus />
                            @error('form.nama_lengkap')
                                <span class="error text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-1">
                        <label class="form-control">
                            <span class="label-text py-2">Jenis Kelamin</span>
                            <select wire:model="form.jenis_kelamin" class="select select-primary w-full max-w-xs">
                                <option selected>Pilih</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('form.jenis_kelamin')
                                <span class="error text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-1">
                        <label class="form-control">
                            <span class="label-text py-2">Tanggal Lahir</span>
                            <input type="date" wire:model="form.tanggal_lahir" placeholder="Masukkan Tanggal Lahir"
                                class="input input-primary bg-gray-100 rounded-md  @error('form.tanggal_lahir') border-red-500 @enderror"
                                autofocus />
                            @error('form.tanggal_lahir')
                                <span class="error text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <!-- Provinsi -->
                <div class="mb-1">
                    <label class="form-control">
                        <span class="label-text py-2">Provinsi</span>
                        <select wire:model="form.provinsi" wire:change="changeProvinsi"
                            class="select select-primary w-full max-w-xs">
                            <option selected>Pilih</option>
                            @foreach ($dataProvinsi as $provinsi)
                                <option value="{{ $provinsi->code }}">{{ $provinsi->name }}</option>
                            @endforeach
                        </select>
                        @error('form.provinsi')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <!-- Kabupaten -->
                <div class="mb-1">
                    <label class="form-control">
                        <span class="label-text py-2">Kabupaten</span>
                        <select wire:model="form.kabupaten" class="select select-primary w-full max-w-xs">
                            <option selected>Pilih</option>
                            @if ($dataKabupaten)
                                @foreach ($dataKabupaten as $kabupaten)
                                    <option value="{{ $kabupaten->code }}">{{ $kabupaten->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('form.kabupaten')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-1">
                <label class="form-control">
                    <span class="label-text py-2">Alamat</span>
                    <textarea wire:model="form.alamat" class="textarea textarea-primary" placeholder="Alamat"></textarea>
                    @error('form.alamat')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col gap-y-3 mt-2">
                <button wire:click.prevent="save()" class="btn btn-primary text-base-100 rounded-md">Tambah</button>
            </div>
        </form>
    </x-authentication-card>

    <div>
        <x-sweet-alert />
        <x-modal-sweet-alert />
        <x-confirm-delete />
    </div>
</div>
