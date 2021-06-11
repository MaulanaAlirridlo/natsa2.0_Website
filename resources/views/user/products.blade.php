@extends('layouts.web')

@section('title')
NATSA
@endsection

@section('body')
<div class="container mx-auto px-6">
    {{-- judul product --}}
    <h3 class="text-gray-700 text-2xl font-medium">Sawah</h3>

    {{-- jumlah product --}}
    <span class="mt-3 text-sm text-gray-500">{{ $riceFields->total() }}+ Products</span>

    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
        @foreach ($riceFields as $riceField)
        <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
            {{-- <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('{{ asset('img/zetong-li-soRA0cugtHI-unsplash.jpg') }}')">
            --}}

            <div class="flex items-end justify-end h-56 w-full bg-cover"
                style="background-image: url('{{ '/storage/'.$riceField->photo->photo_path }}')">
                <form action="{{ route('product.bookmark', $riceField->id) }}" method="POST">
                    <button
                        class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                        title="bookmark" type="submit">
                        @csrf
                        <i class="far fa-bookmark"></i>
                        {{-- <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> --}}
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
@endsection