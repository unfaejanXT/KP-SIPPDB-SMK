@extends('layouts.admin')

@section('title', 'Edit Profil Admin')
@section('header_title', 'Profil Admin')
@section('header_subtitle', 'Kelola informasi profil dan akun anda')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Update Profile Information -->
        <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-100">
            <header class="mb-6">
                <h2 class="text-lg font-medium text-slate-900">
                    Informasi Profil
                </h2>
                <p class="mt-1 text-sm text-slate-600">
                    Perbarui informasi profil akun dan alamat email anda.
                </p>
            </header>

            <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('patch')

                <!-- Photo Preview & Input -->
                <div class="flex items-center gap-6">
                    <div class="shrink-0">
                        @if($user->foto)
                             <img id="preview_foto" class="h-20 w-20 object-cover rounded-full border border-gray-200" src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" />
                        @else
                            <div id="preview_placeholder" class="h-20 w-20 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl font-bold border border-blue-200">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                            <img id="preview_foto" class="hidden h-20 w-20 object-cover rounded-full border border-gray-200" />
                        @endif
                    </div>
                    <div class="flex-1">
                        <x-input-label for="foto" value="Foto Profil" />
                        <input id="foto" name="foto" type="file" class="mt-1 block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                        " onchange="previewImage(this)" />
                        <x-input-error class="mt-2" :messages="$errors->get('foto')" />
                         <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Max. 2MB)</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" value="Nama Lengkap" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <!-- Jabatan -->
                    <div>
                         <x-input-label for="jabatan" value="Jabatan" />
                         <x-text-input id="jabatan" name="jabatan" type="text" class="mt-1 block w-full" :value="old('jabatan', $user->jabatan)" placeholder="Contoh: Administrator, Staff Tata Usaha" />
                         <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-input-label for="nomor_telepon" value="Nomor Telepon / WhatsApp" />
                        <x-text-input id="nomor_telepon" name="nomor_telepon" type="text" class="mt-1 block w-full" :value="old('nomor_telepon', $user->nomor_telepon)" placeholder="08xxxxxxxxxx" />
                        <x-input-error class="mt-2" :messages="$errors->get('nomor_telepon')" />
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>Simpan Perubahan</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-green-600 font-medium"
                        >Berhasil disimpan.</p>
                    @endif
                </div>
            </form>
        </div>

    </div>

    @push('scripts')
    <script>
        function previewImage(input) {
            var preview = document.getElementById('preview_foto');
            var placeholder = document.getElementById('preview_placeholder');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if(placeholder) placeholder.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
@endsection
