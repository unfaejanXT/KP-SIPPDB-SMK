@extends('layouts.public')

@section('content')
@section('hideContact', true)
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    {{-- Header Section --}}
    <div class="max-w-4xl mx-auto text-center mb-10">
        {{-- Logo Wrapper --}}
        <div class="mx-auto h-24 w-24 bg-white rounded-full shadow-lg flex items-center justify-center mb-6 border-4 border-white">
            <x-application-logo class="h-14 w-14 fill-current text-red-700" />
        </div>
        
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
            Pendaftaran Peserta Didik Baru
        </h2>
        <p class="mt-2 text-lg text-gray-600">
            SMK Solusi Bangun Indonesia - Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}
        </p>
    </div>

    {{-- Main Content Card --}}
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            @yield('form-content')
        </div>
    </div>
</div>
@endsection
