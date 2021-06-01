<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedia = SocialMedia::orderBy('created_at', 'asc')->paginate(10);

        return view('admin.socialMedias.socialMedia', [
            'socialMedias' => $socialMedia,
        ]);
    }

    public function search(Request $request)
    {

        $search = Str::of($request->search)->trim();
        $sort = (!is_null($request->sort)) ? $request->sort : 'created_at';
        $order = (!is_null($request->order)) ? $request->order : 'asc';

        $socialMedia = SocialMedia::orderBy($sort, $order)
            ->where('sosmed', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('admin.socialMedias.socialMedia', [
            'socialMedias' => $socialMedia,
        ]);
    }

    public function showStore()
    {
        return view('admin.socialMedias.socialMediaAdd');
    }

    public function showPut(SocialMedia $socialMedia)
    {
        return view('admin.socialMedias.socialMediaPut', [
            'socialMedia' => $socialMedia,
        ]);
    }

    public function store(Request $request)
    {
        // dd("hello");

        $this->validate($request, [
            'sosmed' => 'required|max:150',
        ]);

        $sosmed = SocialMedia::create([
            'sosmed' => $request->sosmed,
            'icon_path' => 'dummy',
        ]);

        if ($request->hasFile('icon')) {
            //buat nama untuk icon
            $file = $request->file('icon');
            $extension = $file->extension();
            $fileName = $sosmed->id . '-' . Str::random(20) . '.' . $extension;

            //simpan icon
            $request->file('icon')->storeAs('public/sosmedIcons', $fileName, '');
            //update icon_path
            $sosmed->update(['icon_path' => 'sosmedIcons/' . $fileName]);
        }

        return redirect()->route('admin.socialMedias');

    }

    public function destroy(SocialMedia $socialMedia, Request $request)
    {
        //hapus icon
        Storage::delete('public/' . $socialMedia->icon_path);

        //hapus data
        $socialMedia->where('id', $socialMedia->id)->delete();

        return redirect()->route('admin.socialMedias');

    }

    public function put(SocialMedia $socialMedia, Request $request)
    {
        $this->validate($request, [
            'sosmed' => 'required|max:150',
        ]);

        $socialMedia->where('id', $socialMedia->id)
            ->update([
                'sosmed' => $request->sosmed,
            ]);

        if ($request->hasFile('icon')) {            
            //buat nama untuk icon baru
            $file = $request->file('icon');
            $extension = $file->extension();
            $fileName = $socialMedia->id . '-' . Str::random(20) . '.' . $extension;

            //simpan icon baru
            $request->file('icon')->storeAs('public/sosmedIcons', $fileName, '');

            //hapus icon lama
            Storage::delete('public/' . $socialMedia->icon_path);

            //update icon_path
            $socialMedia->update(['icon_path' => 'sosmedIcons/' . $fileName]);
        }

        return redirect()->route('admin.socialMedias');
    }
}