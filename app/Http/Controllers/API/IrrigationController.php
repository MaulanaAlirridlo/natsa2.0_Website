<?php

namespace App\Http\Controllers\API;

use App\Models\Irrigation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class IrrigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $irrigation = QueryBuilder::for(Irrigation::class)
                ->allowedFilters(['irrigation'])
                ->defaultSort('-created_at')
                ->allowedSorts(['id', 'created_at', 'irrigation'])
                ->get();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($irrigation->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "data" => $irrigation,
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
        $irrigation = Irrigation::where('id', $id)->firstOrfail();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($irrigation->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data show",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "data" => $irrigation,
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

        $irrigation = QueryBuilder::for(Irrigation::class)
            ->allowedSorts(['id', 'created_at', 'irrigation'])
            ->defaultSort('-created_at')
            ->where('irrigation', 'LIKE', "%{$search}%")
            ->get();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($irrigation->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data search",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "data" => $irrigation,
        ];

        return response()->json($data);
    }
}
