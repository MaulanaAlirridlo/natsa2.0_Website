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
            <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ $user->profile_photo_url }}"
                alt="{{ $user->name }}">
        </div>

        {{-- deskripsi product --}}
        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
            <h3 class="text-gray-700 uppercase text-lg">{{ $user->name }}</h3>

            <hr class="my-3">

            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="alamat">Email:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg">{{ $user->email }}</span>
                </div>
            </div>

            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="daerah">Bergabung pada:</label>
                <div class="flex items-center mt-1">
                    <span class="text-gray-700 text-lg">{{ $user->created_at }}</span>
                </div>
            </div>

            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="count">Social Media:</label>
                <div class="flex items-center mt-1">
                    <button class="h-5 w-5 rounded-full bg-blue-600 border-2 border-blue-200 mr-2 focus:outline-none"></button>
                    <button class="h-5 w-5 rounded-full bg-teal-600 mr-2 focus:outline-none"></button>
                    <button class="h-5 w-5 rounded-full bg-pink-600 mr-2 focus:outline-none"></button>
                </div>
            </div>

            {{-- <div class="flex items-center mt-6">
                <a href="{{ route('makelar.profile', $riceField->user) }}">
            <button
                class="px-8 py-2 bg-green-300 text-white text-sm font-medium rounded hover:bg-green-500 focus:outline-none focus:bg-green-500 w-full md:w-auto">Lihat
                makelar<i class="far fa-eye ml-1"></i></button>
            </a>
        </div> --}}
    </div>
</div>


<div class="mt-16">
    <h3 class="text-gray-600 text-2xl font-medium">Sawah yang dijual</h3>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

        @foreach ($riceFields as $riceField)
        <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
            <a href="{{ route('product', $riceField) }}">
                <div class="flex items-end justify-end h-56 w-full bg-cover"
                    style="background-image: url('{{ '/storage/'.$riceField->photo->photo_path }}')">
                    <button
                        class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                        title="bookmark">
                        <i class="far fa-bookmark"></i>
                        {{-- <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> --}}
                    </button>
                </div>
                <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">{{ $riceField->title }}</h3>
                    <span class="text-gray-500 mt-2">Rp{{ $riceField->harga }}</span>
                </div>
            </a>
        </div>
        @endforeach

    </div>
</div>

</div>
@endsection