@extends('layouts.web')

@section('title','Profile')

@section('body')

    <div class="container flex w-full justify-content-center justify-items-center border">
        
        <div class="md:grid-cols-4 grid grid-cols-1 gap-4">
            
           @include('user.partials.navbarProfile')

            <div class="col-span-3 bg-cool-gray-500">
                <h1>NAMA : NAUFAL FARROS </h1>
                <h1> ALAMAT : Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero, eius nisi. Illo rerum, sit autem ullam placeat dicta incidunt accusantium labore assumenda minima optio repellendus nemo nulla soluta odit illum.</h1>

            </div>

        </div>

    </div>

@endsection