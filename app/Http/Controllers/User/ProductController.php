<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Irrigation;
use App\Models\RiceField;
use App\Models\Verification;
use App\Models\Vestige;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index(Request $request)
    {    


        $tipe = $request->input('tipe');
        $sertifikasi = $request->input('sertifikasi');
        $vestige_id = $request->input('vestige_id');
        $irrigation_id = $request->input('irrigation_id');
        $region_id = $request->input('region_id');
        $verification_id = $request->input('$verification_id');
        
        $riceFields = QueryBuilder::for(RiceField::class) 
            ->select('id', 'title', 'harga', 'tipe')
            ->allowedSorts('harga', 'luas')
            ->with('photo')
            ->when($tipe, function($query, $tipe){
                return $query->where('tipe', '=', $tipe);
            })
            ->when($sertifikasi, function($query, $sertifikasi){
                return $query->where('sertifikasi', '=', $sertifikasi);
            })
            ->when($vestige_id, function($query, $vestige_id){
                return $query->where('vestige_id', '=', $vestige_id);
            })
            ->when($irrigation_id, function($query, $irrigation_id){
                return $query->where('irrigation_id', '=', $irrigation_id);
            })
            ->when($region_id, function($query, $region_id){
                return $query->where('region_id', '=', $region_id);
            })
            ->when($verification_id, function($query, $verification_id){
                return $query->where('verification_id', '=', $verification_id);
            })
            ->paginate(10);

        

        $vestiges = Vestige::orderBy('vestige', 'asc')->get();
        $irrigations = Irrigation::orderBy('irrigation', 'asc')->get();
        $verifications = Verification::orderBy('verification_type', 'asc')->get();

        // return $riceFields;
        return view('user.products', [
            'riceFields' => $riceFields,
            'vestiges' => $vestiges,
            'irrigations' => $irrigations,
            'verifications' => $verifications,
        ]);
    }

    public function show($id)
    {

        $riceField = RiceField::where('id', $id)
            ->with(['user', 'vestige', 'irrigation',
                'region', 'verification', 'photo'])
            ->firstOrFail();

        views($riceField)->record();

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
