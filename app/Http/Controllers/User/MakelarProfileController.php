<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\RiceField;
use App\Http\Controllers\Controller;

class MakelarProfileController extends Controller
{
    public function index(User $user)
    {

        $riceFields = RiceField::select(
            'id',
            'title',
            'harga', )
            ->where('user_id', $user->id)
            ->paginate(20);

        // return $riceFields;
        return view('user.makelarProfile', [
            'riceFields' => $riceFields,
            'user' => $user,
        ]);
    }
}
