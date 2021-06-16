@extends('layouts.web')

@section('title')
NATSA
@endsection

@section('header')

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

@endsection


@section('body')
<div class="container mx-auto px-6 ">
    {{-- judul product --}}
    <h3 class="text-gray-700 text-2xl font-medium">Sawah</h3>

    {{-- jumlah product --}}
    <span class="mt-3 text-sm text-gray-500">{{ $riceFields->total() }}+ Products</span>

    {{-- Filter  --}}
    <div class="my-2">

        <div class=" flex justify-between ">
            {{-- Tooogle filter --}}
            <button class="flex items-center px-3 py-2 text-sm font-medium rounded-md focus:outline-none border"
                id="filter-btn" data-toggle="collapse" data-target="#filters">
                <span>Filter <i class=" fa fa-filter"></i></span>
            </button>

            {{-- Form sorting --}}
            <div>
                <form action="{{ route('products') }}">
                    <select class="form-select text-gray-700 mt-1 block w-full" name="sort" id="sort"
                        onchange="this.form.submit();">
                        <option value="">Urut Berdasarkan</option>
                        <option value="harga">Harga up</option>
                        <option value="-harga">Harga down</option>
                        <option value="luas">Luas up</option>
                        <option value="-luas">Luas down</option>
                    </select>
                </form>

            </div>
        </div>

        <div id="filter-menu">

            <form action="{{ route('products') }}" method="GET" id="regionFilter">
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Jenis sawah</span>
                                <select name="tipe" id="tipe"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">

                                    <option value="">---</option>
                                    <option @isset($_GET['tipe']) @if ($_GET['tipe']=='jual' ) selected
                                        @endif @endisset value="jual">Dijual</option>
                                    <option @isset($_GET['tipe']) @if ($_GET['tipe']=='sewa' ) selected
                                        @endif @endisset value="sewa">Disewakan</option>

                                </select>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Sertifikasi</span>
                                <select name="sertifikasi" id="sertifikasi"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="">---</option>
                                    <option @isset($_GET['sertifikasi']) 
                                        @if ($_GET['sertifikasi']=='shm' ) selected @endif @endisset value="shm">
                                        SHM</option>
                                    <option @isset($_GET['sertifikasi']) 
                                        @if ($_GET['sertifikasi']=='sgb' ) selected @endif @endisset value="sgb">
                                        SGB</option>
                                    <option @isset($_GET['sertifikasi']) 
                                        @if ($_GET['sertifikasi']=='adat' ) selected @endif @endisset value="adat">
                                        Adat</option>
                                    <option @isset($_GET['sertifikasi']) 
                                        @if ($_GET['sertifikasi']=='lainnya' ) selected @endif @endisset value="lainnya">
                                        Lainnya</option>
                                </select>
                            </label>
                        </div>

                    </div>

                    {{-- filter harga dan luas --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 md:gap-4">
                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Luas Tanah</span>

                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    placeholder="Max luas" name="maxLuas" type="number" />
                                </select>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400 hidden md:block">&nbsp;</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    placeholder="Min luas" name="minLuas" type="number" />
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Harga</span>

                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    placeholder="Max harga" name="maxHarga" type="number" />
                                </select>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400 hidden md:block">&nbsp;</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    placeholder="Min harga" name="minHarga" type="number" />
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 md:gap-4">
                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Bekas sawah</span>
                                <select name="vestige_id" id="vestige_id"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">

                                    <option value="">---</option>
                                    @foreach ($vestiges as $vestige)
                                    <option @isset($_GET['vestige_id']) 
                                        @if ($_GET['vestige_id']== $vestige->id ) selected @endif @endisset 
                                        value="{{ $vestige->id }}">{{ $vestige->vestige }}</option>
                                    @endforeach

                                </select>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Jenis Irigasi</span>
                                <select name="irrigation_id" id="irrigation_id"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="">---</option>
                                    @foreach ($irrigations as $irrigation)
                                    <option @isset($_GET['irrigation_id']) 
                                        @if ($_GET['irrigation_id']== $irrigation->id ) selected @endif @endisset
                                        value="{{ $irrigation->id }}">{{ $irrigation->irrigation }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Jenis Verifikasi</span>
                                <select name="verification_id" id="verification_id"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="">---</option>
                                    @foreach ($verifications as $verification)
                                    <option @isset($_GET['verification_id']) 
                                        @if ($_GET['verification_id']== $verification->id ) selected @endif @endisset
                                        value="{{ $verification->id }}">{{ $verification->verification_type }}
                                    </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>


                    <button type="submit"
                        class="px-5 py-3 mt-4 font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                        Terapkan
                    </button>
            </form>

        </div>

        {{-- <div id="filter-menu">

            <div class=" grid grid-col-2 md:grid-col-1 py-5 space-y-2">

                <div class="flex col-span-2 space-x-5">
                    <h2>Min</h2>
                    <input type="range" min="10000000" max="1000000000" value="0" id="range-harga"
                        class="text-green-600">
                    <h2>Max</h2>
                </div>

                <div class="flex col-span-2 ">
                    <h1>Rp. <span id="harga"></span></h1>
                </div>

                <div class="">
                    <label for="" class="bg-gray-100 rounded-md text-2xl">Jenis Sawah</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Ladang</label>

                    <br>
                    <input type="checkbox">
                    <label for="">Perairan</label>
                    <br>

                    <input type="checkbox">
                    <label for="">Celot</label>
                </div>

                <div class="">
                    <label for="" class="bg-gray-100 rounded-md text-2xl">Sertifikasi</label>
                    <br>
                    <input type="checkbox">
                    <label for="">SGH</label>
                    <br>
                    <input type="checkbox">
                    <label for="">OTH</label>
                    <br>
                    <input type="checkbox">
                    <label for="">SAHAM</label>
                    <br>
                </div>

                <div>
                    <label for="" class="bg-gray-100 rounded-md text-2xl">Bekas Sawah</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Jeruk</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Apel</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Kelapa</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Padi</label>
                </div>

                <div>
                    <label for="" class="bg-gray-100 rounded-md text-2xl">Tipe Sawah</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Irigasi</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Bletong</label>
                    <br>


                </div>

                <div>
                    <label for="" class="bg-gray-100 rounded-md text-2xl">Irigasi</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Laut</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Sungai</label>

                </div>

                <div>
                    <label for="" class="bg-gray-100 rounded-md text-2xl">Verivikasi</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Gold</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Platinum</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Silver</label>

                </div>




            </div>

            <div>
                <button class="flex items-center px-3 py-2 text-sm font-medium rounded-md focus:outline-none border">
                    <span>Terapkan</span>
                </button>
            </div>


        </div> --}}

    </div>


    {{-- Foto Produk --}}
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6 ">
        @foreach ($riceFields as $riceField)
        <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">

            <div class="flex items-end justify-end h-56 w-full bg-cover"
                style="background-image: url('{{ '/storage/'.$riceField->photo->photo_path }}')">
                <form action="{{ route('product.bookmark', $riceField->id) }}" method="POST">
                    <button
                        class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                        title="bookmark" type="submit">
                        @csrf
                        <i class="far fa-bookmark"></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('product', $riceField) }}">


                <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">{{ $riceField->title }}</h3>
                    <span class="text-gray-500 mt-2">Rp{{ $riceField->harga }}</span>
                </div>
            </a>
        </div>
        @endforeach

    </div>


    {{-- pagination --}}
    <div class="mt-5">
        {{ $riceFields->links() }}
    </div>
</div>

{{-- Toggle Filter --}}
<script>
    $("#filter-menu").hide();
    $( "#filter-btn" ).click(function() {
        $( "#filter-menu" ).toggle( "slow" );
    });
</script>

@endsection