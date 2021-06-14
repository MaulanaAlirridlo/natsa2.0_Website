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
                    <a href="{{ route('products')}}">

                        <button 
                            class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <span>Lihat sekarang</span>
                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" >
                                <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </a>
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
                    <h2 class="text-2xl text-white font-semibold">Sawah Dijual</h2>
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
                    <h2 class="text-2xl text-white font-semibold">Sawah Disewakan</h2>
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


    {{-- list product --}}
    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Sawah Paling Populer</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

            @foreach ($popularRiceFields as $popularRiceField)
            
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">

                <div class="flex items-end justify-end h-56 w-full bg-cover"
                    style="background-image: url('{{ '/storage/'.$popularRiceField->photo->photo_path }}')">
                    <form action="{{ route('product.bookmark', $popularRiceField->id) }}" method="POST">
                        <button
                            class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                            title="bookmark" type="submit">
                            @csrf
                            <i class="far fa-bookmark"></i>
                        </button>
                    </form>
                </div>
                <a href="{{ route('product', $popularRiceField) }}">
    
    
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $popularRiceField->title }}</h3>
                        <span class="text-gray-500 mt-2">Rp{{ $popularRiceField->harga }}</span>
                        <br>
                        <span class="text-gray-500 mt-2">{{ views($popularRiceField)->count() }}x dilihat</span>
                    </div>
                </a>
            </div>
            
            @endforeach

        </div>
    </div>

    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Sawah terbaru</h3>

        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

            @foreach ($latestRiceFields as $latestRiceField)
            
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">

                <div class="flex items-end justify-end h-56 w-full bg-cover"
                    style="background-image: url('{{ '/storage/'.$latestRiceField->photo->photo_path }}')">
                    <form action="{{ route('product.bookmark', $latestRiceField->id) }}" method="POST">
                        <button
                            class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                            title="bookmark" type="submit">
                            @csrf
                            <i class="far fa-bookmark"></i>
                        </button>
                    </form>
                </div>
                <a href="{{ route('product', $latestRiceField) }}">
    
    
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $latestRiceField->title }}</h3>
                        <span class="text-gray-500 mt-2">Rp{{ $latestRiceField->harga }}</span>
                        <br>
                        <span class="text-gray-500 mt-2">{{ views($latestRiceField)->count() }}x dilihat</span>
                    </div>
                </a>
            </div>
            
            @endforeach

        </div>
    </div>

    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Sawah Dijual Paling Populer</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

            @foreach ($popularSellRiceFields as $popularSellRiceField)
            
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">

                <div class="flex items-end justify-end h-56 w-full bg-cover"
                    style="background-image: url('{{ '/storage/'.$popularSellRiceField->photo->photo_path }}')">
                    <form action="{{ route('product.bookmark', $popularSellRiceField->id) }}" method="POST">
                        <button
                            class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                            title="bookmark" type="submit">
                            @csrf
                            <i class="far fa-bookmark"></i>
                        </button>
                    </form>
                </div>
                <a href="{{ route('product', $popularSellRiceField) }}">
    
    
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $popularSellRiceField->title }}</h3>
                        <span class="text-gray-500 mt-2">Rp{{ $popularSellRiceField->harga }}</span>
                        <br>
                        <span class="text-gray-500 mt-2">{{ views($popularSellRiceField)->count() }}x dilihat</span>
                    </div>
                </a>
            </div>
            
            @endforeach

        </div>
    </div>

    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Sawah Disewakan Paling Populer</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

            @foreach ($popularRentRiceFields as $popularRentRiceField)
            
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">

                <div class="flex items-end justify-end h-56 w-full bg-cover"
                    style="background-image: url('{{ '/storage/'.$popularRentRiceField->photo->photo_path }}')">
                    <form action="{{ route('product.bookmark', $popularRentRiceField->id) }}" method="POST">
                        <button
                            class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                            title="bookmark" type="submit">
                            @csrf
                            <i class="far fa-bookmark"></i>
                        </button>
                    </form>
                </div>
                <a href="{{ route('product', $popularRentRiceField) }}">
    
    
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $popularRentRiceField->title }}</h3>
                        <span class="text-gray-500 mt-2">Rp{{ $popularRentRiceField->harga }}</span>
                        <br>
                        <span class="text-gray-500 mt-2">{{ views($popularRentRiceField)->count() }}x dilihat</span>
                    </div>
                </a>
            </div>
            
            @endforeach


        </div>
    </div>

</div>
@endsection