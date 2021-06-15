@extends('layouts.web')

@section('title')
NATSA
@endsection

@section('header')

<link href="https://fonts.googleapis.com/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">



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
            <button type="button" id="filter-btn"  class=" bg-gray-100 rounded-lg hover:bg-gray-300 font-serif w-20" data-toggle="collapse" data-target="#filters">Filters <i class="fa fa-filter"></i></button>
                {{-- Urut --}}
                <div class="hidden md:block">
                    <label for="urut-berdasar" class="text-gray-500">Urut berdasar : </label>
                    <select name="" id="urut-berdasar" class="h-10 border border-gray-400 rounded-lg text-gray-600">
                        <option value="--urut berdasar--">--urut berdasar--</option>
                        <option value="daerah">daerah</option>
                        <option value="harga">harga</option>
                    </select>
                </div>
        </div>

        <div class="w-1/2 rounded-lg" id="filter-menu">
            
            <div class=" grid grid-col-2 md:grid-col-1 py-5 space-y-2">
                <div class="flex col-span-2 space-x-5">
                    <h2>Min</h2>
                    <input type="range" min="10000000" max="1000000000" value="0" id="range-harga" class="text-green-600" >
                    <h2>Max</h2>
                </div>
                
                <div class="flex col-span-2 ">
                    <h1 >Rp. <span id="harga"></span></h1>
                </div>
                
                    <div class="">
                        <label for="" class="bg-gray-100 rounded-md text-2xl font-serif">Jenis Sawah</label>
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
                        <label for="" class="bg-gray-100 rounded-md text-2xl font-serif">Sertifikasi</label>
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
                    <label for="" class="bg-gray-100 rounded-md text-2xl font-serif">Bekas Sawah</label>
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
                    <label for="" class="bg-gray-100 rounded-md text-2xl font-serif">Tipe Sawah</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Irigasi</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Bletong</label>
                    <br>
                    
    
                </div>

                <div>
                    <label for="" class="bg-gray-100 rounded-md text-2xl font-serif">Irigasi</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Laut</label>
                    <br>
                    <input type="checkbox">
                    <label for="">Sungai</label>
               
                </div>

                <div>
                    <label for="" class="bg-gray-100 rounded-md text-2xl font-serif">Verivikasi</label>
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
                    <Button type="" class="bg-teal-300 w-32 h-10 rounded-md text-xl font-thin">Apply</Button>
                </div>
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

        {{ $riceFields->links() }}


    </div>


    {{-- pagination --}}
    <div class="mt-5">
        {{ $riceFields->links() }}
    </div>
</div>




    <script>
        var slider = document.getElementById("range-harga");
        var output = document.getElementById("harga");
        output.innerHTML = slider.value;
        
        slider.oninput = function() {
        output.innerHTML = this.value;
        }

        
    </script>

    {{-- Toggle Filter --}}
    <script>
        $("#filter-menu").hide();
        $( "#filter-btn" ).click(function() {
          $( "#filter-menu" ).toggle( "slow" );
        });
        </script>

@endsection