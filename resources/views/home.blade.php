@extends('layouts.pages.app')

@section('title', 'Home')

@section('content')
<!-- Hero Header -->
<section class="bg-cover bg-center relative" style="background-image: url('{{ asset('assets/images/hero.jpeg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
    <div class="relative grid max-w-screen-xl px-4 py-32 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12">
        <div class="lg:col-span-12 text-center">
            <h1 class="max-w-4xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-white mx-auto">
                PPDB SMK SWASTA SOLUSI BANGUN INDONESIA
            </h1>
            <p class="max-w-2xl mb-6 font-light text-gray-300 lg:mb-8 md:text-lg lg:text-xl mx-auto">
                Registrasi Pendaftaran Dibuka
            </p>
            <p class="max-w-2xl mb-6 font-light text-gray-300 lg:mb-8 md:text-lg lg:text-xl mx-auto">
                12 Mei 2024 - 12 Juni 2024
            </p>
            <x-primary-button tag="a" href="{{ route('login') }}" class="px-5 py-3 mr-3">
                DAFTAR CALON SISWA BARU
                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </x-primary-button>
        </div>
    </div>
</section>

<!-- Content -->


@endsection
