<?php

namespace App\Http\Controllers\User;

use App\Models\RiceField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $riceFields = RiceField::select('id', 'title', 'harga')->paginate(20);

        return view('user.products', [
            'riceFields' => $riceFields,
        ]);
    }

    public function show($id){

        $riceField = RiceField::where('id', $id)->with(['user', 'vestige', 'irrigation', 'region', 'verification'])->firstOrFail();

        $randomRiceFields = RiceField::limit(4)->inRandomOrder()->get();

        return view('user.product', [
            'riceField' => $riceField,
            'randomRiceFields' => $randomRiceFields,
        ]);
    }
}
