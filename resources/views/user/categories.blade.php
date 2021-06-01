@extends('layouts.web')

@section('title')
NATSA
@endsection

@section('body')
<div class="container mx-auto px-6">

    {{-- one big banner --}}
    <div class="h-64 rounded-md overflow-hidden bg-cover bg-center"
        style="background-image: url('{{ asset('img/francois-le-nguyen-vr-IeEWgyts-unsplash.jpg') }}')">
        <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
            <div class="px-10 max-w-xl">
                <h2 class="text-2xl text-white font-semibold">Sawah</h2>
                <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore facere
                    provident molestias ipsam sint voluptatum pariatur.</p>
                <button
                    class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <span>Lihat sekarang</span>
                    <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- 
        2 banner 
        bisa dijadikan 3 tapi harus diubah sedikit 
        --}}
    <div class="md:flex mt-8 md:-mx-4">

        <div class="w-full h-64 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:w-1/2"
            style="background-image: url('{{ asset('img/sandy-manoa-Y678onxFoJI-unsplash.jpg') }}')">
            <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                <div class="px-10 max-w-xl">
                    <h2 class="text-2xl text-white font-semibold">Sawah dijual</h2>
                    <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore
                        facere provident molestias ipsam sint voluptatum pariatur.</p>
                    <button
                        class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                        <span>Lihat sekarang</span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full h-64 mt-8 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:mt-0 md:w-1/2"
            style="background-image: url('{{ asset('img/tuan-nguy-n-minh-aQ7pxUrm2HM-unsplash.jpg') }}')">
            <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                <div class="px-10 max-w-xl">
                    <h2 class="text-2xl text-white font-semibold">Sawah Disewa</h2>
                    <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore
                        facere provident molestias ipsam sint voluptatum pariatur.</p>
                    <button
                        class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                        <span>Lihat sekarang</span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection