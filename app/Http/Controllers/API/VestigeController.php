<?php

namespace App\Http\Controllers\API;

use App\Models\Vestige;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class VestigeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vestige = QueryBuilder::for(Vestige::class)
                ->allowedFilters(['vestige'])
                ->defaultSort('-created_at')
                ->allowedSorts(['id', 'created_at', 'vestige'])
                ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($vestige->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "vestige" => $vestige,
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
        $vestige = Vestige::where('id', $id)->get();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($vestige->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data show",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "vestige" => $vestige,
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

        $vestige = QueryBuilder::for(Vestige::class)
            ->allowedSorts(['id', 'created_at', 'vestige'])
            ->defaultSort('-created_at')
            ->where('vestige', 'LIKE', "%{$search}%")
            ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($vestige->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data search",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "vestige" => $vestige,
        ];

        return response()->json($data);
    }
}
