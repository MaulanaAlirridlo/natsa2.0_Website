<?php

namespace App\Http\Controllers\User;

use App\Models\RiceField;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $riceFields = RiceField::select(
            'id', 
            'title', 
            'harga',)
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

    public function search(Request $request)
    {
        $riceFields = RiceField::select(
            'id', 
            'title', 
            'harga',
            DB::raw("(SELECT CONCAT(regions.provinsi, ', ', regions.kabupaten) from 
            regions where regions.id = rice_fields.region_id) as regions"), )
            ->with('photo')
            ->havingRaw("regions LIKE '%{$request->search}%'")
            ->paginate(20);

        // return $riceFields;
        return view('user.products', [
            'riceFields' => $riceFields,
        ]);
    }

}
