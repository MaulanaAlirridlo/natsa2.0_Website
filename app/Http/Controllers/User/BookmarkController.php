<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\RiceField;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

        $riceFields = RiceField::join('bookmarks', 'rice_fields.id', '=' ,'bookmarks.rice_field_id')
            ->select('rice_fields.id', 'rice_fields.title', 'rice_fields.harga', 'rice_fields.user_id', 'bookmarks.id as bookmarks_id')
            ->where('bookmarks.user_id', auth()->user()->id)
            ->with('photo', 'user')
            ->paginate(5);

        // return $riceFields;
        return view('user.profile.bookmarks', [
            'riceFields' => $riceFields,
        ]);
    }

    public function store(RiceField $riceField, Request $request)
    {

        if ($riceField->bookmarkedBy($request->user())) {
            return response('Anda sudah menyimpan sawah ini', 409);
            // return abort(409);
        } else {
            $riceField->bookmark()->create([
                'user_id' => $request->user()->id,
            ]);
        }

        return back();

    }

    public function destroy(Bookmark $bookmark){

        if(!$bookmark->ownBy(auth()->user())){
            return "ini bukan punya mu";
        }

        $bookmark->where('id', $bookmark->id)->delete();

        return back();
    }

    public function destroyFromProduct(Bookmark $bookmark, $id){

        $bookmark = Bookmark::where('bookmarks.rice_field_id', $id)
            ->where('bookmarks.user_id', auth()->user()->id)
            ->delete();

        return back();

    }
    
}
