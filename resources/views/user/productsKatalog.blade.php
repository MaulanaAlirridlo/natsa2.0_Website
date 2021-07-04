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
            <br>
            <span class="text-gray-500 mt-2">{{ $riceField->regions }}</span>
        </div>
    </a>
</div>
@endforeach