<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\RiceField;
use App\Models\UserSocialMedia;
use App\Http\Controllers\Controller;

class MakelarProfileController extends Controller
{
    public function index(User $user)
    {

        $riceFields = RiceField::select(
            'id',
            'title',
            'harga', )
            ->with('photo')
            ->where('user_id', $user->id)
            ->paginate(20);
        
        $makelarSocialMedias = UserSocialMedia::where('user_id', $user->id)
            ->with('socialMedia')
            ->get();

        // return $makelarSocialMedias;
        return view('user.makelarProfile', [
            'riceFields' => $riceFields,
            'user' => $user,
            'makelarSocialMedias' => $makelarSocialMedias,
        ]);
    }
}
