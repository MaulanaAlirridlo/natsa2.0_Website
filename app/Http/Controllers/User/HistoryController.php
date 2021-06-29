<?php

namespace App\Http\Controllers\User;

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
        ->with('photo', 'user')
        ->paginate(5);

        // return $riceFields;

        return view('user.profile.dashboard', [
            'riceFields' => $riceFields,
        ]);
    }

    public function destroy($id){

        UserHistory::where('id', $id)
            ->where('user_id', auth()->user()->id)->delete();

        return back();

    }
}
