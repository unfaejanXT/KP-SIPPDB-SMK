<x-guest-layout>

    <div class="flex flex-col items-center justify-center gap-2">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <p class="m-0 text-[16px] font-semibold dark:text-black">Selamat Datang Calon Siswa Baru</p>
        <span class="m-0 text-xs max-w-[90%] text-center text-[#8B8E98]">Silahkan isi form dibawah ini untuk mulai
            mendaftar.
        </span>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        {{-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div> --}}

        <!-- Email Address -->
        <!-- <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <p class="text-sm text-gray-500">
                Masukkan 10 digit NISN dari ijazah SMP
            </p>
        </div> -->


        <!-- NISN -->
        <div class="mt-4">
            <x-input-label for="nisn" :value="__('NISN')" />
            <x-text-input id="nisn" class="block mt-1 w-full py-1 text-lg" type="text" name="nisn" :value="old('nisn')"
                required pattern="\d{10}" />
            <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
            <p class="text-xs text-gray-400 mt-1">
                Masukkan 10 digit NISN yang tertera pada ijazah SMP.
            </p>
        </div>

        <!-- No WhatsApp Yang Aktif -->

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Nomor Telepon/WhatsApp')" />
            <x-text-input id="phone" class="block mt-1 w-full py-1 text-lg" type="tel" name="phone"
                :value="old('phone')" required pattern="[0-9]{10,15}" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            <p class="text-xs text-gray-400 mt-1">
                Masukkan nomor telepon atau WhatsApp aktif (10-15 digit).
            </p>
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full py-1 text-lg" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full py-1 text-lg" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="space-y-4">
            <!-- Tombol Submit -->
            <button type="submit"
                class="w-full text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">
                Create an account
            </button>

            <!-- Sudah Mendaftar -->
            <div class="flex justify-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Sudah Mendaftar? Ayo Masuk Sekarang!') }}
                </a>
            </div>
        </div>


    </form>
</x-guest-layout>