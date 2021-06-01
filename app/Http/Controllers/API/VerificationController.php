<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verification = QueryBuilder::for(Verification::class)
                ->allowedFilters(['verification_type'])
                ->defaultSort('-created_at')
                ->allowedSorts(['id', 'created_at', 'verification_type'])
                ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($verification->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "verification" => $verification,
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
        $verification = Verification::where('id', $id)->get();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($verification->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data show",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "verification" => $verification,
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

        $verification = QueryBuilder::for(Verification::class)
            ->allowedSorts(['id', 'created_at', 'verification_type'])
            ->defaultSort('-created_at')
            ->where('verification_type', 'LIKE', "%{$search}%")
            ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($verification->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data search",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "verification" => $verification,
        ];

        return response()->json($data);
    }
}