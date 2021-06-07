<?php

namespace App\Http\Controllers\API;

use App\Models\Region;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $region = QueryBuilder::for(Region::class)
                ->allowedFilters(['kabupaten', 'provinsi'])
                ->defaultSort('-created_at')
                ->allowedSorts(['id', 'created_at', 'kabupaten', 'provinsi'])
                ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($region->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "region" => $region,
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::where('id', $id)->get();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($region->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data show",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "region" => $region,
        ];

        return response()->json($data);
    }

    /**
     * Display the searched resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {
        $search = Str::of($search)->trim();

        $region = QueryBuilder::for(Region::class)
            ->allowedSorts(['id', 'created_at', 'kabupaten', 'provinsi'])
            ->defaultSort('-created_at')
            ->where('provinsi', 'LIKE', "%{$search}%")
            ->orWhere('kabupaten', 'LIKE', "%{$search}%")
            ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($region->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data search",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "region" => $region,
        ];

        return response()->json($data);
    }
}
