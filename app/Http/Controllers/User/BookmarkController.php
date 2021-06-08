<?php

namespace App\Http\Controllers\User;

use App\Models\Bookmark;
use App\Models\RiceField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookmarkController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $bookmark = Bookmark::all();

        return $bookmark;
    }

    public function store(RiceField $riceField, Request $request){

        if ($riceField->bookmarkedBy($request->user())) {
            return response('Anda sudah menyimpan sawah ini', 409);
            // return abort(409);
        }
        else{
            $riceField->bookmark()->create([
                'user_id' => $request->user()->id,
            ]);
        }

        return back();

    }
}
