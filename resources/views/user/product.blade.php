@extends('layouts.web')

@section('title')
NATSA
@endsection

@section('header')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
<!-- leafletjs -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
@endsection
@section('body')
<div class="container mx-auto px-6">

    {{-- detail product --}}
    <div class="md:flex md:items-center">

        {{-- gambar product --}}

        <div class="swiper-container mySwiper w-full h-64 md:w-1/2 lg:h-96 ">
            <div class="swiper-wrapper ">
                @foreach ($riceField->photos as $photo)
                <div class="swiper-slide">
                    <img class="flex h-full w-full rounded-md object-cover max-w-lg mx-auto"
                        src="{{ '/storage/'.$photo->photo_path }}" alt="{{ $photo->title }}">
                </div>
                @endforeach

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination font-extrabold"></div>
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
                    <span class="text-gray-700 text-lg" >{{ $riceField->region }}</span>
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


    <div>
        <div id="mapid" class="" style="height: 400px"></div>
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
                <label class="text-gray-700 text-sm" for="alamat">No Hp:</label>
                <div class="flex items-center mt-1">
                    @auth
                    <span class="text-gray-700 text-lg">
                        {{ $riceField->user->no_hp }}
                    </span>
                    @endauth
                    @guest
                    <span class="text-gray-700 text-sm">
                        Login untuk melihat nomor HP
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

            <div class="mt-3">
                <label class="text-gray-700 text-sm" for="count">Sosmed:</label>
                <div class="flex items-center mt-1">
                    @auth
                    @foreach ($makelarSocialMedias as $socialMedia)
                    <a href="{{ $socialMedia->link }}" target="_blank">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">

                            <img class="object-cover w-full h-full rounded-full"
                                src="{{ '/storage/'.$socialMedia->socialMedia->icon_path }}" alt="" loading="lazy" />
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                    </a>

                    {{-- <button class="h-5 w-5 rounded-full bg-blue-600 border-2 border-blue-200 mr-2 focus:outline-none"></button> --}}
                    @endforeach
                    @endauth
                    @guest
                    <span class="text-gray-700 text-sm">
                        Login untuk melihat social media
                    </span>
                    @endguest
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

    {{-- <input type="hidden" name="polygon" id="polygon" value="{{ $polygon }}"> --}}
    
    <div id="polygon" class="hidden">@php echo $riceField->vector @endphp</div>
</div>
@section('script')
<!-- jquery-->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- leafletjs -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>


<script>
    // bagian untuk leafletjs ==================================================
    var lan = -2.49607;
    var lon = 117.89587;
    var zoom = 5;
    var mymap = L.map('mapid');
    var themarker = null;
    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms (1 seconds)
    var layer = null;
    var draw = $('#polygon').text();
    draw = JSON.parse(draw);
    var region = "{{ $riceField->maps }}";

    mymap.setView([lan, lon], zoom);
    
    osm = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    // var latlngs = [{'lat':-1.845383988573187,'lng':111.43562261897505},{'lat':-0.9667509997666298,'lng':111.43562261897505},{'lat':-0.9667509997666298,'lng':113.01834694093131},{'lat':-1.845383988573187,'lng':113.01834694093131}];
    var latlngs = draw;
    var polygon = L.polygon(latlngs, {color: 'red'}).addTo(mymap);
    mymap.fitBounds(polygon.getBounds(), {maxZoom:13});

    $.get("https://nominatim.openstreetmap.org/search?format=json&q="+region, function( data ) {

        lan = data[0]['lat'];
        lon = data[0]['lon'];
        // console.log(data[0]);
        mymap.setView([lan, lon]);
        themarker = L.marker([lan, lon]).addTo(mymap);

    });
    //swiper
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
@endsection
@endsection