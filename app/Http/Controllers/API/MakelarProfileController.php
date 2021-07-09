<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\RiceField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MakelarProfileController extends Controller
{
    public function index($id)
    {

        $riceField = RiceField::select(
            'id',
            'title',
            'harga', )
            ->with('photo')
            ->where('user_id', $id)
            ->where('ketersediaan', "1")
            // ->paginate(20);
            ->get();

        $user = User::where('id', $id)->first();

        // return $riceField;

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($riceField->count() <= 0 || $user->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "riceField" => $riceField,
            "user" => $user,
        ];

        return response()->json($data);
    }
}
