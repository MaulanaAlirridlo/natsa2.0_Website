@extends('layouts.web')

@section('title')
NATSA
@endsection

@section('header')

@endsection

@section('body')
<div class="container mx-auto px-6">
    {{-- judul product --}}
    <h3 class="text-gray-700 text-2xl font-medium">Sawah</h3>

    {{-- jumlah product --}}
    <span class="mt-3 text-sm text-gray-500">{{ $riceFields->total() }}+ Products</span>

    <div class="my-2">

        <div class=" flex justify-between ">
            {{-- Tooogle filter --}}
            <button class="flex items-center px-3 py-2 text-sm font-medium rounded-md focus:outline-none border"
                id="filter-btn" data-toggle="collapse" data-target="#filters">
                <span>Filter <i class=" fa fa-filter"></i></span>
            </button>

            {{-- Form sorting --}}
            <div>
                <select class="form-select text-gray-700 mt-1 block w-full" name="sort" id="sort">
                    <option value="">Urut Berdasarkan</option>
                    <option value="harga">Harga up</option>
                    <option value="-harga">Harga down</option>
                    <option value="luas">Luas up</option>
                    <option value="-luas">Luas down</option>
                </select>

            </div>
        </div>

        {{-- Filter  --}}
        <div id="filter-menu">

            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                {{-- filter jenis sawah dan sertifikasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                    <div>
                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400">Jenis sawah</span>
                            <select name="tipe" id="tipe"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">

                                <option value="">---</option>
                                <option @isset($_GET['tipe']) @if ($_GET['tipe']=='jual' ) selected @endif @endisset
                                    value="jual">Dijual</option>
                                <option @isset($_GET['tipe']) @if ($_GET['tipe']=='sewa' ) selected @endif @endisset
                                    value="sewa">Disewakan</option>

                            </select>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400">Sertifikasi</span>
                            <select name="sertifikasi" id="sertifikasi"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                <option value="">---</option>
                                <option @isset($_GET['sertifikasi']) @if ($_GET['sertifikasi']=='shm' ) selected @endif
                                    @endisset value="shm">
                                    SHM</option>
                                <option @isset($_GET['sertifikasi']) @if ($_GET['sertifikasi']=='sgb' ) selected @endif
                                    @endisset value="sgb">
                                    SGB</option>
                                <option @isset($_GET['sertifikasi']) @if ($_GET['sertifikasi']=='adat' ) selected @endif
                                    @endisset value="adat">
                                    Adat</option>
                                <option @isset($_GET['sertifikasi']) @if ($_GET['sertifikasi']=='lainnya' ) selected
                                    @endif @endisset value="lainnya">
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
                                placeholder="Min luas" name="minLuas" id="minLuas" type="number" />
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400 hidden md:block">&nbsp;</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Max luas" name="maxLuas" id="maxLuas" type="number" />
                            </select>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400">Harga</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Min harga" name="minHarga" id="minHarga" type="number" />
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400 hidden md:block">&nbsp;</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Max harga" name="maxHarga" id="maxHarga" type="number" />
                            </select>
                        </label>
                    </div>

                </div>

                {{-- filter jenis irigasi dan bekas sawah --}}
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                    <div>
                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400">Bekas sawah</span>
                            <select name="vestige_id" id="vestige_id"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">

                                <option value="">---</option>
                                @foreach ($vestiges as $vestige)
                                <option @isset($_GET['vestige_id']) @if ($_GET['vestige_id']==$vestige->id )
                                    selected @endif @endisset
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
                                <option @isset($_GET['irrigation_id']) @if ($_GET['irrigation_id']==$irrigation->id
                                    ) selected @endif @endisset
                                    value="{{ $irrigation->id }}">{{ $irrigation->irrigation }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                </div>


                <button id="filter"
                    class="px-5 py-3 mt-4 font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Terapkan
                </button>

            </div>

        </div>

        {{-- Foto Produk --}}
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6" id="katalog">

            @include('user.productsKatalog')

        </div>

    </div>

    {{-- pagination --}}
    <div class="mt-5">
        {{ $riceFields->links() }}
    </div>
</div>
</div>
@endsection


@section('script')

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>
    $('body').on('click', '#filter', function () {

        var tipe = $('#tipe').val();
        var sertifikasi = $('#sertifikasi').val();
        var vestige_id = $('#vestige_id').val();
        var irrigation_id = $('#irrigation_id').val();
        var maxLuas = $('#maxLuas').val();
        var minLuas = $('#minLuas').val();
        var maxHarga = $('#maxHarga').val();
        var minHarga = $('#minHarga').val();
        var minHarga = $('#minHarga').val();
        var minHarga = $('#minHarga').val();
        var sort = $('#sort').val();
        var region = $('#region').val();
        

        $("#katalog").text('hello test');
        
        var data = "tipe=" + tipe + "&";
        data += "sertifikasi=" + sertifikasi + "&";
        data += "vestige_id=" + vestige_id + "&";
        data += "irrigation_id=" + irrigation_id + "&";
        data += "maxLuas=" + maxLuas + "&";
        data += "minLuas=" + minLuas + "&";
        data += "maxHarga=" + maxHarga + "&";
        data += "minHarga=" + minHarga + "&";
        data += "sort=" + sort + "&";
        data += "region=" + region;

        $("#katalog").load("{{ route('products.katalog') }}", data);

    });

    $("#sort").on('change',function(){

        var tipe = $('#tipe').val();
        var sertifikasi = $('#sertifikasi').val();
        var vestige_id = $('#vestige_id').val();
        var irrigation_id = $('#irrigation_id').val();
        var maxLuas = $('#maxLuas').val();
        var minLuas = $('#minLuas').val();
        var maxHarga = $('#maxHarga').val();
        var minHarga = $('#minHarga').val();
        var minHarga = $('#minHarga').val();
        var minHarga = $('#minHarga').val();
        var sort = $('#sort').val();
        var region = $('#region').val();

        var data = "tipe=" + tipe + "&";
        data += "sertifikasi=" + sertifikasi + "&";
        data += "vestige_id=" + vestige_id + "&";
        data += "irrigation_id=" + irrigation_id + "&";
        data += "maxLuas=" + maxLuas + "&";
        data += "minLuas=" + minLuas + "&";
        data += "maxHarga=" + maxHarga + "&";
        data += "minHarga=" + minHarga + "&";
        data += "sort=" + sort + "&";
        data += "region=" + region;

        $("#katalog").load("{{ route('products.katalog') }}", data);
    });

    // Toggle Filter 
    $("#filter-menu").hide();
    $( "#filter-btn" ).click(function() {
        $( "#filter-menu" ).toggle( "slow" );
    });
</script>
@endsection