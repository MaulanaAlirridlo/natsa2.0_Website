<?php

namespace App\Http\Controllers\API;

use App\Models\Bookmark;
use App\Models\RiceField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookmarkController extends Controller
{
    
    public function index(){

        $bookmarks = RiceField::join('bookmarks', 'rice_fields.id', '=' ,'bookmarks.rice_field_id')
            ->select('rice_fields.id', 'rice_fields.title', 'rice_fields.harga', 'rice_fields.user_id', 'bookmarks.id as bookmarks_id')
            ->where('bookmarks.user_id', auth()->user()->id)
            ->with('photo', 'user')
            ->paginate(5);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($bookmarks->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "bookmarks" => $bookmarks,
        ];

        return response()->json($data);
    }

    public function store($id, Request $request){

        // return response()->json($request->user());

        $riceField = RiceField::where('id', $id)->firstOrfail();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Sawah berhasil ditandai",
        ];

        if ($riceField->bookmarkedBy($request->user())) {

            $status = [
                "code" => 409,
                "message" => "Fail",
                "description" => "Sawah sudah disimpan",
            ];

        } else {
            $riceField->bookmark()->create([
                'user_id' => $request->user()->id,
            ]);
        }

        $data = [
            "status" => $status,
            "riceField" => $riceField,
        ];

        return response()->json($data);

    }

    public function update(){

    }

    public function destroy($id){

        $bookmark = Bookmark::where('id', $id)->delete();

        $status = [
            "code" => 204,
            "message" => "Succes",
            "description" => "Bookmark berhasil dihapus",
        ];

        $data = [
            "status" => $status,
            "riceField" => $bookmark,
        ];

        return response()->json($data);

    }

}
