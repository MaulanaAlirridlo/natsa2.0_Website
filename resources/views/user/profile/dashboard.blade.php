@extends('layouts.web')

@section('title','Profile')

@section('body')

<div class="container mx-auto px-6">

    <h3 class="text-gray-700 text-2xl font-medium">Dashboard</h3>
    <div class="flex flex-col md:flex-row mt-8">

        <div class="w-full md:w-1/3 order-1 flex flex-none md:flex-col md:justtify-end">

            @include("user.partials.navbarProfile")

        </div>

        <div class="w-full mb-8 flex-shrink-0 order-2 md:w-2/3 md:mb-0 md:order-2">

            <h2 class="text-gray-700 text-1xl font-medium mb-4">History</h2>
            
            @foreach ($riceFields as $riceField)
            <div class="flex justify-center md:justify-end mb-4">

                <div class="border rounded-md w-full px-4 py-3">

                    <div class="flex items-center justify-end gap-4">
                        <h3 class="text-gray-700 font-medium"></h3>
                        <a href="{{ route('makelar.profile', $riceField->user) }}">
                            <span class="text-gray-600 text-sm">Makelar</span>
                        </a>
                        <a href="{{ route('product', $riceField) }}">
                            <span class="text-gray-600 text-sm">Lihat</span>
                        </a>

                        <form action="{{ route('user.history.delete', $riceField->user_histories_id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="return confirm('Buang sawah dari history?')" class="text-gray-600 text-sm red"">
                                Hapus
                            </button>
                        </form>
                        
                    </div>

                    <div class="flex justify-between mt-6">
                        <div class="flex">
                            <img class="h-20 w-20 object-cover rounded"
                                src="{{ '/storage/'.$riceField->photo->photo_path }}"
                                alt="">
                            <div class="mx-3">
                                <h3 class="text-sm text-gray-600">{{ $riceField->title }}</h3>
                            </div>
                        </div>
                        <span class="text-gray-600">Rp{{ $riceField->harga }}</span>
                    </div>

                </div>

            </div>    
            @endforeach
            
            {{ $riceFields->links() }}

        </div>

    </div>
</div>

@endsection