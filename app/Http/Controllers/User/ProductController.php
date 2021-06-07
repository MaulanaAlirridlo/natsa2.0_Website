<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RiceField;

class ProductController extends Controller
{
    public function index()
    {
        $riceFields = RiceField::select('id', 'title', 'harga')
            ->with('photo')
            ->paginate(20);

        // return $riceFields;
        return view('user.products', [
            'riceFields' => $riceFields,
        ]);
    }

    public function show($id)
    {

        $riceField = RiceField::where('id', $id)
            ->with(['user', 'vestige', 'irrigation',
                'region', 'verification', 'photo'])
            ->firstOrFail();

        $randomRiceFields = RiceField::select('id', 'title', 'harga')
            ->with('photo')
            ->limit(4)
            ->inRandomOrder()->get();

        // return $randomRiceFields;
        return view('user.product', [
            'riceField' => $riceField,
            'randomRiceFields' => $randomRiceFields,
        ]);
    }
}
