<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Irrigation;
use App\Models\Region;
use App\Models\RiceField;
use App\Models\RiceFieldPhoto;
use App\Models\User;
use App\Models\Verification;
use App\Models\Vestige;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RiceFieldController extends Controller
{
    public function index()
    {
        $riceField = RiceField::orderBy('created_at', 'asc')->with(['user', 'vestige', 'irrigation', 'region', 'verification'])->paginate(10);

        return view('admin.riceFields.riceField', [
            'riceFields' => $riceField,
        ]);
    }

    public function showStore()
    {
        $users = User::where('role', 'user')->orderBy('name', 'asc')->get();
        $vestiges = Vestige::orderBy('vestige', 'asc')->get();
        $irrigations = Irrigation::orderBy('irrigation', 'asc')->get();
        $regions = Region::orderBy('provinsi', 'asc')->get();
        $verifications = Verification::orderBy('verification_type', 'asc')->get();

        return view('admin.riceFields.riceFieldAdd', [
            'users' => $users,
            'vestiges' => $vestiges,
            'irrigations' => $irrigations,
            'regions' => $regions,
            'verifications' => $verifications,
        ]);
    }

    public function showPut(RiceField $riceField)
    {
        $users = User::where('role', 'user')->orderBy('name', 'asc')->get();
        $vestiges = Vestige::orderBy('vestige', 'asc')->get();
        $irrigations = Irrigation::orderBy('irrigation', 'asc')->get();
        $regions = Region::orderBy('provinsi', 'asc')->get();
        $verifications = Verification::orderBy('verification_type', 'asc')->get();

        return view('admin.riceFields.riceFieldPut', [
            'riceField' => $riceField,
            'users' => $users,
            'vestiges' => $vestiges,
            'irrigations' => $irrigations,
            'regions' => $regions,
            'verifications' => $verifications,
        ]);
    }

    public function show(RiceField $riceField)
    {
        return view('admin.riceFields.riceFieldShow', [
            'riceField' => $riceField,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:100',
            'harga' => 'required|max:11',
            'luas' => 'required|max:11',
            'alamat' => 'required|max:1024',
            'deskripsi' => 'required|max:1024',
            'maps' => 'required|max:254',
            'sertifikasi' => 'required|max:20',
            'tipe' => 'required|max:20',
            'pemilik' => 'required',
            'vestige' => 'required',
            'region' => 'required',
            'irrigation' => 'required',
            'verification' => 'required',
        ]);

        $riceField = RiceField::create([
            'title' => $request->title,
            'harga' => $request->harga,
            'alamat' => $request->alamat,
            'luas' => $request->luas,
            'deskripsi' => $request->deskripsi,
            'maps' => $request->maps,
            'sertifikasi' => $request->sertifikasi,
            'tipe' => $request->tipe,
            'user_id' => $request->pemilik,
            'vestige_id' => $request->vestige,
            'region_id' => $request->region,
            'irrigation_id' => $request->irrigation,
            'verification_id' => $request->verification,
        ]);

        if ($request->hasFile('photo')) {
            //buat nama baru untuk fotonya
            $files = $request->file('photo');
            $i = 1;
            foreach ($files as $file) {
                $extension = $file->extension();
                $fileName = $riceField->id . '-' . $i . '-' . Str::random(20) . '.' . $extension;

                // simpan foto di server
                $file->storeAs('/riceFieldPhotos', $fileName, '');

                //simpan nama ke database
                RiceFieldPhoto::create([
                    'rice_field_id' => $riceField->id,
                    'photo_path' => 'riceFieldPhotos/' . $fileName,
                ]);

                $i++;
            }
        }

        return redirect()->route('admin.riceFields');

    }

    public function destroy(RiceField $riceField)
    {
        $riceField->where('id', $riceField->id)->delete();

        return redirect()->route('admin.riceFields');

    }

    public function put(RiceField $riceField, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'harga' => 'required|max:11',
            'luas' => 'required|max:11',
            'alamat' => 'required|max:1024',
            'deskripsi' => 'required|max:1024',
            'maps' => 'required|max:254',
            'sertifikasi' => 'required|max:20',
            'tipe' => 'required|max:20',
            'pemilik' => 'required',
            'vestige' => 'required',
            'region' => 'required',
            'irrigation' => 'required',
            'verification' => 'required',
        ]);

        $riceField->where('id', $riceField->id)
            ->update([
                'title' => $request->title,
                'harga' => $request->harga,
                'alamat' => $request->alamat,
                'luas' => $request->luas,
                'deskripsi' => $request->deskripsi,
                'maps' => $request->maps,
                'sertifikasi' => $request->sertifikasi,
                'tipe' => $request->tipe,
                'user_id' => $request->pemilik,
                'vestige_id' => $request->vestige,
                'region_id' => $request->region,
                'irrigation_id' => $request->irrigation,
                'verification_id' => $request->verification,
            ]);

        return redirect()->route('admin.riceFields');
    }
}
