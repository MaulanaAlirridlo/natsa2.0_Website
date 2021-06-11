@extends('layouts.web')

@section('title','Profile')

@section('body')

    <div class="container flex w-full justify-content-center justify-items-center ">
        
        <div class="md:grid-cols-4 grid grid-cols-1 gap-4 md:gap-36">
           @include('user.partials.navbarProfile')

            <div class="col-span-3">
                       
               
                        <div class="border border-blue-600 rounded-md max-w-md w-full px-4 py-3 my-5">
                            <div class="flex items-center justify-between">
                               <a href="">
                                   
                                   <button class=" text-blue-600 focus:outline-none" >
                                   <i class="far fa-bookmark"> Hapus</i>
                                  </button>

                               </a>
                               
                            </div>
                            <div class="flex justify-between mt-6">
                                <div class="flex">
                                    <img class="h-20 w-20 object-cover rounded" src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" alt="">
                                    <div class="mx-3">
                                        <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                                        
                                    </div>
                                </div>
                                <span class="text-gray-600">20$</span>
                            </div>
                        </div>
                        <div class="border rounded-md max-w-md w-full px-4 py-3 my-5">
                            <div class="flex items-center justify-between">
                                <a href="">
                                   
                                    <button class=" text-blue-600 focus:outline-none" >
                                    <i class="far fa-bookmark"></i>
                                   </button>
 
                                </a>
                                <a href=""> 
                                    <button class="text-red-700 hover:text-red-900">
                                        <i class="far fa-trash-alt"></i>

                                    </button>
                                </a>
                            </div>
                            <div class="flex justify-between mt-6">
                                <div class="flex">
                                    <img class="h-20 w-20 object-cover rounded" src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" alt="">
                                    <div class="mx-3">
                                        <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                                        <div class="flex items-center mt-2">
                                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                            <span class="text-gray-700 mx-2">2</span>
                                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-gray-600">20$</span>
                            </div>
                        </div>
                        <div class="border rounded-md max-w-md w-full px-4 py-3 my-5">
                            <div class="flex justify-between mt-0">
                                <div class="flex">
                                    <img class="h-32 w-32 object-cover rounded" src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" alt="">
                                    <div class="mx-3">
                                        <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                                    </div>
                                </div>
                                <a href="">
                                    <button class="text-red-700">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </a>
                                
                            </div>
                        </div>
                  
                   

            </div>

        </div>
    </div>

@endsection

