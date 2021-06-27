@extends('layouts.web')

@section('title')
NATSA
@endsection

@section('header')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

<style>
    .carousel-open:checked+.carousel-item {
        position: static;
        opacity: 100;
    }

    .carousel-item {
        -webkit-transition: opacity 0.6s ease-out;
        transition: opacity 0.6s ease-out;
    }

    #carousel-1:checked~.control-1,
    #carousel-2:checked~.control-2,
    #carousel-3:checked~.control-3 {
        display: block;
    }

    .carousel-indicators {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        bottom: 2%;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 10;
    }

    #carousel-1:checked~.control-1~.carousel-indicators li:nth-child(1) .carousel-bullet,
    #carousel-2:checked~.control-2~.carousel-indicators li:nth-child(2) .carousel-bullet,
    #carousel-3:checked~.control-3~.carousel-indicators li:nth-child(3) .carousel-bullet {
        color: #2b6cb0;
        /*Set to match the Tailwind colour you want the active one to be */
    }
</style>
@endsection
@section('body')
<div class="container mx-auto px-6">

    {{-- detail product --}}
    <div class="md:flex md:items-center">
        {{-- gambar product --}}

        <div class="w-full h-64 md:w-1/2 lg:h-96">
            <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto"
                src="{{ '/storage/'.$riceField->photo->photo_path }}" alt="{{ $riceField->title }}">
        </div>


        {{-- carousel Foto produk --}}
        {{-- <div class="carousel-inner relative overflow-hidden w-full h-full md:h-1/2 md:w-1/2 ">
            <!--Slide 1-->
                <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
                <div class="carousel-item absolute opacity-0" style="height:50vh;">
                    <div class="flex h-full w-full ">
                        <img src="https://statik.tempo.co/data/2019/08/07/id_861750/861750_720.jpg" alt="">
                    </div>
                </div>
                <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!--Slide 2-->
                <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
                <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="flex h-full w-full ">
                    <img src="https://i1.wp.com/www.dara.co.id/wp-content/uploads/2019/09/Sawah.jpg?fit=900%2C460&ssl=1" alt="">
                </div>
                </div>
                <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label> 
            <!--Slide 3-->
                <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
                <div class="carousel-item absolute opacity-0" style="height:50vh;">
                    <div class="flex h-full w-full ">
                        <img src="https://cdn.popmama.com/content-images/post/20200929/artikel-popmama-21png-49a4320113961f16d7c09ec12d634c49_600xauto.png" alt="">
                    </div>
                </div>
                <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
        
                <!-- Add additional indicators for each slide-->
            <ol class="carousel-indicators">
                <li class="inline-block mr-3">
                    <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
            </ol>

        </div> --}}


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
                        {{ @$riceField->vestige }}, {{ @$riceField->irrigation }}
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
                @guest

                <form action="{{ route('product.bookmark', $riceField->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Simpan
                        sawah <i class="far fa-bookmark ml-1"></i></button>
                </form>
                @endguest

                @auth

                @if ($riceField->bookmarkedBy(auth()->user()))

                <form action="{{ route('product.bookmark.delete', $riceField->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" onclick="return confirm('Buang sawah dari bookmark?')"
                        class="px-8 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-500 focus:outline-none focus:bg-red-500">Hapus
                        Sawah <i class="far fa-bookmark ml-1"></i></button>
                    
                </form>
                @else

                <form action="{{ route('product.bookmark', $riceField->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Simpan
                        sawah <i class="far fa-bookmark ml-1"></i></button>
                </form>

                    
                @endif

                @endauth
            </div>

        </div>
    </div>

    <hr class="mt-10 mb-3">

    {{-- detail Makelar --}}
    <div class="md:flex md:items-center">
        {{-- avatar makelar --}}
        <div class="w-full h-64 md:w-1/2 lg:h-96">
            <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto"
                src="{{ $riceField->user->profile_photo_url }}" alt="{{ $riceField->user->name }}">
        </div>

        {{-- data diri makelar --}}
        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
            <h3 class="text-gray-700 uppercase text-lg">{{ $riceField->user->name }}</h3>

            <hr class="my-3">

            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="alamat">Email:</label>
                <div class="flex items-center mt-1">
                    @auth
                    <span class="text-gray-700 text-lg">
                        {{ $riceField->user->email }}
                    </span>
                    @endauth
                    @guest
                    <span class="text-gray-700 text-sm">
                        Login untuk melihat email
                    </span>
                    @endguest
                </div>
            </div>

            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="daerah">Bergabung sejak:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg">{{ $riceField->user->created_at->toDateString() }}</span>
                </div>
            </div>

            <div class="flex items-center mt-6">
                <a href="{{ route('makelar.profile', $riceField->user) }}">
                    <button
                        class="px-8 py-2 bg-green-300 text-white text-sm font-medium rounded hover:bg-green-500 focus:outline-none focus:bg-green-500 w-full md:w-auto">Lihat
                        makelar<i class="far fa-eye ml-1"></i></button>
                </a>
            </div>
        </div>
    </div>


    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Sawah yang lain</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

            @foreach ($randomRiceFields as $randomRiceField)
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                <a href="{{ route('product', $randomRiceField) }}">
                    <div class="flex items-end justify-end h-56 w-full bg-cover"
                        style="background-image: url('{{ '/storage/'.$randomRiceField->photo->photo_path }}')">
                        <button
                            class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                            title="bookmark">
                            <i class="far fa-bookmark"></i>
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