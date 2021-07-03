<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserSocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request, [
            'sosmedId' => ["required", "numeric"],
            'sosmedLink' => ['required', 'url', 'max:100'],
        ]);

        $exist = UserSocialMedia::where('social_media_id', $request->sosmedId)
            ->where('user_id', auth()->user()->id)->get();

        if($exist->count() > 0){
            return back()->with('error', 'Wow, satu sosmed hanya boleh satu link');
        }

        $sosmed = UserSocialMedia::create([
            'user_id' => auth()->user()->id,
            'social_media_id' => $request->sosmedId,
            'link' => $request->sosmedLink,
        ]);

        if (!$sosmed) {
            return back()->with('error', 'Wow kok ada yang salah');
        }

        return back()->with('success', 'Berhasil');

    }

    public function destroy(UserSocialMedia $userSocialMedia)
    {

        $userSocialMedia->delete();

        return back();

    }

    public function update(UserSocialMedia $userSocialMedia, Request $request)
    {

        $this->validate($request, [
            'updateLink' => ['required', 'url', 'max:100'],
        ]);

        $sosmed = $userSocialMedia->update([
            'link' => $request->updateLink,
        ]);

        if (!$sosmed) {
            return back()->with('error', 'Wow kok ada yang salah');
        }

        return back()->with('success', 'Berhasil');
    }
}
