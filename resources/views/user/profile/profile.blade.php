@extends('layouts.web')

@section('title','Profile')

@section('body')

<div class="container mx-auto px-6">

    <h3 class="text-gray-700 text-2xl font-medium">Profile</h3>
    <div class="flex flex-col md:flex-row mt-8">

        <div class="w-full md:w-1/2 order-1 flex flex-none md:flex-col md:justtify-end ">

            @include("user.partials.navbarProfile")

        </div>

        <div class="w-full mb-8 flex-shrink-0 order-2 md:w-1/2 md:mb-0 md:order-2 ">

            <div class="grid grid-cols-2 ">
                
                
                <div class="col-span-2 md:col-span-1 ">
                        <div>
                            <div>
                                <Label class="">Nama :  </Label>
                                <input type="text" value="{{ Auth::User()->name }}" class=" text-justifyborder shadow ">

                            </div>
                            
                            <div>

                                <label for=""> Email : {{Auth::User()->email}} </label>
                            </div>
                        
    
                        
                        
                        
                         
                                

                        </div>
                </div>
                
                <div class="col-span-2 md:col-span-1 mt-8 md:mt-0">
                    <div class="flex justify-center  ">
                            <div class="flex h-32 w-32 mt-2 shadow-xl rounded-full ">
                                <img src="https://statik.tempo.co/data/2019/08/07/id_861750/861750_720.jpg" alt="" class="flex rounded-full">
                                
                            </div>
                    </div>
                        
                    <div class="flex justify-center mt-4 ">
                        <button class="bg-white rounded-md hover:bg-gray-100 text-lg text-center w-32 h-10 border border-gray">
                            Ganti Foto
                        </button>

                    </div>
                </div>
                
            </div>
            
                    <div class="flex  justify-center w-full mt-4">
                        <button class="w-20 h-10 bg-white border border-gray-300 hover:bg-gray-100 rounded-md">
                            Simpan

                        </button>
                    </div>
            

        </div>

    </div>
</div>

@endsection