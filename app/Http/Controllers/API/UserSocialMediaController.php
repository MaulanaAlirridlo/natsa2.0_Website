<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserSocialMedia;
use Illuminate\Http\Request;

class UserSocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userSocialMedias = UserSocialMedia::where('user_id', auth()->user()->id)
            ->with('socialMedia')
            ->get();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($userSocialMedias->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "userSocialMedia" => $userSocialMedias,
        ];

        return response()->json($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sosmedId' => ["required", "numeric"],
            'sosmedLink' => ['required', 'url', 'max:100'],
        ]);

        $sosmed = UserSocialMedia::create([
            'user_id' => auth()->user()->id,
            'social_media_id' => $request->sosmedId,
            'link' => $request->sosmedLink,
        ]);

        $status = [
            "code" => 201,
            "message" => "Succes",
            "description" => "Data berhasil dibuat",
        ];

        if (!$sosmed) {
            $status = [
                "code" => 204,
                "message" => "Error",
                "description" => "Entah kenapa kayaknya ada yang salah",
            ];
        }

        $data = [
            "status" => $status,
            "userSocialMedia" => $sosmed,
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'updateLink' => ['required', 'url', 'max:100'],
        ]);

        $update = UserSocialMedia::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->update([
                'link' => $request->updateLink,
            ]);

        $status = [
            "code" => 201,
            "message" => "Succes",
            "description" => "Berhasil diupdate",
        ];

        if (!$update) {
            $status = [
                "code" => 204,
                "message" => "Error",
                "description" => "Wow kok ada yang salah, cobak periksa lagi",
            ];
        }

        $data = [
            "status" => $status,
            "UserSocialMedia" => $update,
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = UserSocialMedia::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->delete();

        $status = [
            "code" => 204,
            "message" => "Succes",
            "description" => "Berhasil dihapus",
        ];

        if (!$delete) {
            $status = [
                "code" => 400,
                "message" => "Error",
                "description" => "Wow kok ada yang salah, cobak periksa lagi",
            ];
        }

        $data = [
            "status" => $status,
            "UserSocialMedia" => $delete,
        ];

        return response()->json($data);
    }
}
