<?php

namespace App\Http\Controllers\API;

use App\Models\RiceField;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{

    public function index(){
        $riceFields = RiceField::join('user_histories', 'rice_fields.id', '=' ,'user_histories.rice_field_id')
            ->select('rice_fields.id', 'rice_fields.title', 'rice_fields.harga', 'rice_fields.user_id', 'user_histories.id as user_histories_id')
            ->where('user_histories.user_id', auth()->user()->id)
            ->where('ketersediaan', '1')
            ->with('photo', 'user')
            ->paginate(5);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($riceFields->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "riceField" => $riceFields,
        ];

        return response()->json($data);

    }

    public function destroy($id){

        UserHistory::where('id', $id)
            ->where('user_id', auth()->user()->id)->delete();

            $riceField = RiceField::where('id', $id)->delete();

        $status = [
            "code" => 204,
            "message" => "Succes",
            "description" => "Histori berhasil dihapus",
        ];

        $data = [
            "status" => $status,
            "riceField" => $riceField,
        ];

        return response()->json($data);

    }

}
