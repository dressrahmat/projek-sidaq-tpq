<div>

    <x-dialog-modal wire:model.live="modalEdit" submit="edit">
        <x-slot name="title">
            Form Edit Profile
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-2 gap-3">
                <!-- Photo Profile -->
                <div class="mb-2 ">
                    <label class="form-control">
                        <span class="label-text text-base-content mb-2">Upload Photo Profile</span>
                        <div class="relative mb-2">
                            <label for="photo_profile" class="cursor-pointer flex items-center justify-center">
                                <div class="shadow-lg w-full h-[350px] rounded-lg flex items-center justify-center bg-cover bg-center"
                                    style="background-image: url('{{ !$form->photo_profile ? asset('assets/images/website/add-image-persegi.png') : (is_string($form->photo_profile) ? 'storage/' . $form->photo_profile : $form->photo_profile->temporaryUrl()) }}');">
                                    @if (!$form->photo_profile || !is_object($form->photo_profile) || !$form->photo_profile instanceof UploadedFile)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    @endif
                                </div>
                            </label>
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
                                <option @if ($form->jenis_kelamin == 'L') selected @endif value="L">Laki-Laki
                                </option>
                                <option @if ($form->jenis_kelamin == 'P') selected @endif value="P">Perempuan
                                </option>
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
                                <option @if ($form->provinsi == $provinsi->code) selected @endif value="{{ $provinsi->code }}">
                                    {{ $provinsi->name }}</option>
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
                                    <option @if ($form->kabupaten == $kabupaten->code) selected @endif
                                        value="{{ $kabupaten->code }}">{{ $kabupaten->name }}
                                    </option>
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

        </x-slot>


        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('modalEdit', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled">
                Simpan
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
