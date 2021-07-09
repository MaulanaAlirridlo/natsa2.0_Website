@extends('layouts.web')

@section('title','User-Sell-Put')

@section('header')
<!-- leafletjs -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
@endsection

@section('body')

<div class="container mx-auto px-6">


    <h3 class="text-gray-700 text-2xl font-medium">Sell</h3>

    <div class="flex flex-col md:flex-row mt-8">

        <div class="w-full md:w-1/3 order-1 flex flex-none md:flex-col md:justtify-end">

            @include("user.partials.navbarProfile")

        </div>

        <div class="w-full mb-8 flex-shrink-0 order-2 md:w-2/3 md:mb-0 md:order-2">

            <div class="w-full overflow-hidden rounded-lg">
                <form action="{{ route('user.sell.update', $riceField) }}" method="POST" id="riceFieldAdd"
                    enctype="multipart/form-data">

                    @method('PUT')
                    @csrf
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Judul</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Judul" name="title" type="text" required maxlength="100"
                                value="{{ $riceField->title }}" />

                            @error('title')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                            @enderror
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Harga
                                </span>
                                <div class="relative">
                                    <input
                                        class="block w-full pl-20 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                        placeholder="Harga" name="harga" type="number" required
                                        value="{{ $riceField->harga }}" />
                                    <button disabled
                                        class="absolute inset-y-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-l-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                        Rp
                                    </button>
                                </div>
                                @error('harga')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                                @enderror
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Luas
                                </span>
                                <div class="relative">
                                    <input
                                        class="block w-full pl-20 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                        placeholder="Luas" name="luas" type="number" required
                                        value="{{ $riceField->luas }}" />
                                    <button disabled
                                        class="absolute inset-y-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-l-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                        m<sup>2</sup>
                                    </button>
                                </div>
                                @error('luas')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                                @enderror
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">


                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Alamat</span>
                                <textarea
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                    rows="3" placeholder="Alamat" name="alamat"
                                    required>{{ $riceField->alamat }}</textarea>
                                @error('alamat')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                                @enderror
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Deskripsi</span>
                                <textarea
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                    rows="3" placeholder="Deskripsi" name="deskripsi"
                                    required>{{ $riceField->deskripsi }}</textarea>
                                @error('deskripsi')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                                @enderror
                            </label>

                        </div>

                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400">Maps</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="maps" name="maps" id="maps" type="text" required maxlength="100"
                                value="{{ $riceField->maps }}" />
                            @error('maps')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                            @enderror

                            <div id="mapid" class="w-full mt-4" style="height: 400px"></div>

                            <input type="hidden" id="latlgn" name="vector">
                        </label>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Sertifikasi</span>
                                <select name="sertifikasi" id="sertifikasi" required
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="">---</option>
                                    <option @if ($riceField->sertifikasi == 'shm') selected @endif value="shm">SHM
                                    </option>
                                    <option @if ($riceField->sertifikasi == 'sgb') selected @endif value="sgb">SGB
                                    </option>
                                    <option @if ($riceField->sertifikasi == 'adat') selected @endif value="adat">Adat
                                    </option>
                                    <option @if ($riceField->sertifikasi == 'lainnya') selected @endif
                                        value="lainnya">Lainnya</option>
                                </select>
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Tipe</span>
                                <select name="tipe" id="tipe" required
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="">---</option>
                                    <option @if ($riceField->tipe == 'jual') selected @endif value="jual">Jual</option>
                                    <option @if ($riceField->tipe == 'sewa') selected @endif value="sewa">Sewa</option>
                                </select>
                            </label>

                        </div>

                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400">Daerah</span>
                            <select name="region" id="region" required
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                <option value="">---</option>
                                @foreach ($regions as $region)
                                <option @if ($riceField->region_id == $region->id) selected @endif
                                    value="{{ $region->id }}">{{ $region->provinsi }}, {{ $region->kabupaten }}</option>
                                @endforeach
                            </select>
                        </label>

                        <div class="grid grid-cols-2 gap-4 mt-4">

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Bekas Sawah</span>
                                <select name="vestige" id="vestige" required
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="">---</option>
                                    @foreach ($vestiges as $vestige)
                                    <option @if ($riceField->vestige_id == $vestige->id) selected @endif
                                        value="{{ $vestige->id }}">{{ $vestige->vestige }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Irigasi</span>
                                <select name="irrigation" id="irrigation" required
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="">---</option>
                                    @foreach ($irrigations as $irrigation)
                                    <option @if ($riceField->irrigation_id == $irrigation->id) selected @endif
                                        value="{{ $irrigation->id }}">{{ $irrigation->irrigation }}</option>
                                    @endforeach
                                </select>
                            </label>

                        </div>
                        
                        <div class="block text-sm my-4" id="oldPic">
                            <span class="text-gray-700 dark:text-gray-400">Hapus gambar lama</span>
                            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 mt-6">
                                @foreach ($riceField->photos as $photo)
                                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden relative">
        
                                    <div class="flex items-end justify-end h-56 w-full bg-cover"
                                        style="background-image: url('{{ '/storage/'.$photo->photo_path }}')">
                                    </div>
        
        
                                    <button id="fotoSawah" data-id="{{ $photo->id }}" type="button"
                                        class="absolute top-0 right-0 p-2 bg-red-600 text-white hover:bg-red-500 focus:outline-none focus:bg-red-500"
                                        title="bookmark">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400">Upload gambar baru</span>
                            <input class="mt-1" name="photo[]" id="photo" type="file" data-max-file-size="512KB"
                                data-max-files="5" accept="image/png, image/jpeg, image/gif" multiple />
                        </label>
                </form>


            </div>

        </div>

        <div class="">
            <a href="{{ route('user.sell') }}">
                <button
                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-purple">
                    Batal
                </button>
            </a>

            <button type="submit" form="riceFieldAdd"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Update Sawah
            </button>
        </div>

    </div>

    <div id="polygon" class="hidden">@php echo $riceField->vector @endphp</div>

</div>
</div>

@endsection

@section('script')
<!-- jquery-->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- leafletjs -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>

<script>

    var lan = -2.49607;
    var lon = 117.89587;
    var zoom = 5;
    var mymap = L.map('mapid');
    var themarker = null;
    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms (1 seconds)
    var layer = null;
    var draw = $('#polygon').text();
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

    $.get("https://nominatim.openstreetmap.org/search?format=json&q="+region, function( data ) {

        lan = data[0]['lat'];
        lon = data[0]['lon'];
        // console.log(data[0]);
        mymap.setView([lan, lon]);
        themarker = L.marker([lan, lon]).addTo(mymap);

    });

    if (draw != '') {        
        draw = JSON.parse(draw);
        var latlngs = draw;
        var polygon = L.polygon(latlngs, {color: 'red'}).addTo(mymap);
        mymap.fitBounds(polygon.getBounds(), {maxZoom:13});
    }

    var drawnItems = new L.featureGroup().addTo(mymap);

    L.control.layers(
        {
            osm: osm,
        },
        { 
            drawlayer: drawnItems
        },
        { 
            position: "topleft", 
            collapsed: false 
        }
    ).addTo(mymap);

    mymap.addControl(new L.Control.Draw({
            edit: {
                featureGroup: drawnItems,
                poly: {
                    allowIntersection: false,
                },
            },
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true,
                },
                polyline: false,
                rectangle: true,
                circle: false,
                marker: false,
            },
        })
    );

    mymap.on(L.Draw.Event.CREATED, function (event) {
        if(layer){
            mymap.removeLayer(layer);
        }
        layer = event.layer;
        drawnItems.addLayer(layer);

        var thecoor = layer.getLatLngs()[0];
        var thecoorjson = JSON.stringify(thecoor);
        
        $('#latlgn').val(thecoorjson);

    });

    $('#maps').keyup(function(){

        clearTimeout(typingTimer);
        if ($('#maps').val()) {
            typingTimer = setTimeout(setMap, doneTypingInterval);
        }

    });

    function setMap(){

        var search = $( "#maps" ).val();

        $.get("https://nominatim.openstreetmap.org/search?format=json&q="+search, function( data ) {
            
            
            if(themarker){
                mymap.removeLayer(themarker);
            }

            if (data[0]) {
                lan = data[0]['lat'];
                lon = data[0]['lon'];
                zoom = 14

                mymap.setView([lan, lon], zoom);
                themarker = L.marker([lan, lon], {
                    draggable: true,
                }).addTo(mymap);
            }

        });

    };

    // bagian untuk hapus foto ==================================================
    $('body').on('click', "#fotoSawah", function () {

        // alert( "Removing item with an id of " + $(this).data("id") );
        if (confirm('Yakin dihapus?')) {     
            var formData = {
                id: $(this).data("id"),
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            });

            $.ajax({
                type:'DELETE',
                url:"{{ route('user.sell.delete.photo') }}",
                data: formData,
                dataType: 'json',
                success:function(data) {
                    $("#oldPic").load(" #oldPic > *");
                },
                error:function(data) {
                    console.log(data);
                }
            });
        }
        
    });
    
    // bagian untuk filepond ==================================================
    FilePond.registerPlugin(
        // encodes the file as base64 data
        FilePondPluginFileEncode,
        
        // validates the size of the file
        FilePondPluginFileValidateSize,
        
        // corrects mobile image orientation
        FilePondPluginImageExifOrientation,
        
        // previews dropped images
        FilePondPluginImagePreview,

        // validatae type
        FilePondPluginFileValidateType,

    );

    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="photo"]');
    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
    //setup upload file
    FilePond.setOptions({
        server: {
            url: '/riceField/upload',
            process: '/add',
            revert: '/delete',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

</script>

@endsection