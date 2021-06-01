@extends('layouts.web')

@section('title')
NATSA
@endsection

@section('body')
<div class="container mx-auto px-6">
        
    {{-- detail product --}}
    <div class="md:flex md:items-center">
        {{-- gambar product --}}
        <div class="w-full h-64 md:w-1/2 lg:h-96">
            <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ asset('img/zetong-li-soRA0cugtHI-unsplash.jpg') }}" alt="{{ $riceField->title }}">
        </div>
        {{-- deskripsi product --}}
        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
            <h3 class="text-gray-700 uppercase text-lg">{{ $riceField->title }}</h3>
            <span class="text-gray-500 mt-3">Rp{{ $riceField->harga }}</span>

            <hr class="my-3">
            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="alamat">Alamat:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg">{{ $riceField->alamat }}</span>
                </div>
            </div>
            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="daerah">Daerah:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg">{{ $riceField->region }}</span>
                </div>
            </div>
            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="deskripsi">Deskripsi:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg">{{ $riceField->deskripsi }}</span>
                </div>
            </div>
            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="sertifikasi">Sertifikasi:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg uppercase">{{ $riceField->sertifikasi }}</span>
                </div>
            </div>
            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="kategori">Tipe:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg">{{ $riceField->tipe }}</span>
                </div>
            </div>
            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="kategori">Kategori:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg">
                        {{ @$riceField->vestige }}, {{ @$riceField->irrigation }}, {{ @$riceField->verification }}
                    </span>
                </div>
            </div>

            {{-- <div class="mt-2">
                <label class="text-gray-700 text-sm" for="count">Count:</label>
                <div class="flex items-center mt-1">
                    <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                    <span class="text-gray-700 text-lg mx-2">20</span>
                    <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                </div>
            </div>
            <div class="mt-3">
                <label class="text-gray-700 text-sm" for="count">Color:</label>
                <div class="flex items-center mt-1">
                    <button class="h-5 w-5 rounded-full bg-blue-600 border-2 border-blue-200 mr-2 focus:outline-none"></button>
                    <button class="h-5 w-5 rounded-full bg-teal-600 mr-2 focus:outline-none"></button>
                    <button class="h-5 w-5 rounded-full bg-pink-600 mr-2 focus:outline-none"></button>
                </div>
            </div> --}}

            <div class="flex items-center mt-6">
                <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Simpan sawah</button>
                <button class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                    <i class="far fa-bookmark"></i>
                    {{-- <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> --}}
                </button>
            </div>
        </div>
    </div>


    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Sawah yang lain</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
            @foreach ($randomRiceFields as $randomRiceField)
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                <a href="{{ route('product', $randomRiceField) }}">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('{{ asset('img/zetong-li-soRA0cugtHI-unsplash.jpg') }}')">
                        <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500" title="bookmark">
                            <i class="far fa-bookmark"></i>
                            {{-- <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> --}}
                        </button>
                    </div>
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $randomRiceField->title }}</h3>
                        <span class="text-gray-500 mt-2">Rp{{ $randomRiceField->harga }}</span>
                    </div>
                </a>
            </div> 
            @endforeach

        </div>
    </div>

</div>
@endsection
