@extends('layouts.web')

@section('title','Profile')

@section('body')

<div class="container mx-auto px-6">

    <h3 class="text-gray-700 text-2xl font-medium">Bookmark</h3>
    <div class="flex flex-col md:flex-row mt-8">

        <div class="w-full md:w-1/2 order-1 flex flex-none md:flex-col md:justtify-end">

            @include("user.partials.navbarProfile")

        </div>

        <div class="w-full mb-8 flex-shrink-0 order-2 md:w-1/2 md:mb-0 md:order-2">

            Disini semestinya ada history penjelajahan

        </div>

    </div>
</div>

@endsection