<?php

namespace App\Http\Controllers\User;

use App\Models\Region;
use App\Models\Vestige;
use App\Models\RiceField;
use App\Models\Irrigation;
use Illuminate\Http\Request;
use App\Models\RiceFieldPhoto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function index()
    {

        $riceFields = RiceField::select('id', 'title', 'harga', 'user_id', 'ketersediaan')
            ->where('user_id', auth()->user()->id)   
            ->with('photo', 'user')
            ->paginate(5);

        return view('user.sell.sell',[
            'riceFields' => $riceFields,
        ]);

    }

    public function destroy(RiceField $riceField)
    {
        $riceField->where('id', $riceField->id)->delete();

        return redirect()->route('user.sell.sell');

    }

    public function showStore()
    {
        $vestiges = Vestige::orderBy('vestige', 'asc')->get();
        $irrigations = Irrigation::orderBy('irrigation', 'asc')->get();
        $regions = Region::orderBy('provinsi', 'asc')->get();

        return view('user.sell.sellAdd', [
            'vestiges' => $vestiges,
            'irrigations' => $irrigations,
            'regions' => $regions,
        ]);
    }

    public function showPut(RiceField $riceField)
    {
        // $riceField = $riceField->with('photos')->first();
        $riceField = RiceField::where('id', $riceField->id)->with('photos')->first();

        $vestiges = Vestige::orderBy('vestige', 'asc')->get();
        $irrigations = Irrigation::orderBy('irrigation', 'asc')->get();
        $regions = Region::orderBy('provinsi', 'asc')->get();

        // return $riceField;
        return view('user.sell.sellPut', [
            'riceField' => $riceField,
            'vestiges' => $vestiges,
            'irrigations' => $irrigations,
            'regions' => $regions,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => ['required','max:100','string','regex:/^[\pL\s\-]+$/u'],
            'harga' => ['required','digits_between:1,11','numeric'],
            'luas' => ['required','digits_between:1,11','numeric'],
            'alamat' => ['required','max:1024','regex:/^[\pL\s\-]+$/u'],
            'deskripsi' => ['required','max:1024','regex:/^[\pL\s\-]+$/u'],
            'maps' => ['required','max:100'],
            'sertifikasi' => ['required','max:20','string','regex:/^[\pL\s\-]+$/u'],
            'tipe' => ['required','max:20','string','regex:/^[\pL\s\-]+$/u'],
            'vestige' => 'required',
            'region' => 'required',
            'irrigation' => 'required',
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
            'user_id' => auth()->user()->id,
            'vestige_id' => $request->vestige,
            'region_id' => $request->region,
            'irrigation_id' => $request->irrigation,
        ]);

        //Proses upload photo
        //buat nama baru untuk fotonya
        $files = $request->photo;
        $i = 1;
        foreach ($files as $file) {
            $newFileName = $riceField->id . '-' . $file;

            // pindah foto ke storage/riceFields
            Storage::move('riceFieldPhotos/temps/'.$file, 'riceFieldPhotos/'.$newFileName);

            //simpan nama ke database
            RiceFieldPhoto::create([
                'rice_field_id' => $riceField->id,
                'photo_path' => 'riceFieldPhotos/' . $newFileName,
            ]);

            $i++;
        }


        return redirect()->route('product', $riceField);

    }

    public function put(RiceField $riceField, Request $request)
    {  

        $this->validate($request, [
            'title' => ['required','max:100','string','regex:/^[\pL\s\-]+$/u'],
            'harga' => ['required','digits_between:1,11','numeric'],
            'luas' => ['required','digits_between:1,11','numeric'],
            'alamat' => ['required','max:1024','regex:/^[\pL\s\-]+$/u'],
            'deskripsi' => ['required','max:1024','regex:/^[\pL\s\-]+$/u'],
            'maps' => ['required','max:100'],
            'sertifikasi' => ['required','max:20','string','regex:/^[\pL\s\-]+$/u'],
            'tipe' => ['required','max:20','string','regex:/^[\pL\s\-]+$/u'],
            'vestige' => 'required',
            'region' => 'required',
            'irrigation' => 'required',
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
                'vestige_id' => $request->vestige,
                'region_id' => $request->region,
                'irrigation_id' => $request->irrigation,
            ]);
        
        if($request->has('photo')){

            $files = $request->photo;
            $i = 1;

            foreach ($files as $file) {
                $newFileName = $riceField->id . '-' . $file;
    
                // pindah foto ke storage/riceFields
                Storage::move('riceFieldPhotos/temps/'.$file, 'riceFieldPhotos/'.$newFileName);
    
                //simpan nama ke database
                RiceFieldPhoto::create([
                    'rice_field_id' => $riceField->id,
                    'photo_path' => 'riceFieldPhotos/' . $newFileName,
                ]);
    
                $i++;
            }

        }
        
        
        

        return redirect()->route('product', $riceField);
    }

    public function putKetersediaan(RiceField $riceField)
    {

        if(auth()->user()->id != $riceField->user_id){
            abort(403);
        }

        $ketersediaan = "1";
        if($riceField->ketersediaan == 1){
            $ketersediaan = "0";
        }

        // return "berhasil, ketersediaan = $ketersediaan";

        $update = $riceField->where('id', $riceField->id)
            ->update(['ketersediaan' => $ketersediaan]);

        // return $update;

        return redirect()->route('user.sell');

    }

    public function destroyPhoto(Request $request){

        $this->validate($request,[
            'id' => 'required|numeric',
        ]);
        
        //ambil data
        $riceFieldPhoto = RiceFieldPhoto::where('id', $request->id)->first();

        //hapus foto di storage
        $file = $riceFieldPhoto->photo_path;
        $delete = Storage::delete($file);

        //hapus data di database
        $destroy = $riceFieldPhoto->delete();

        $msg = "Berhasil dihapus";

        if(!$destroy || !$delete){
            $msg = 'Ops, ada yang salah';
        }
        
        return response()->json(array('msg'=> $msg), 200);

    }
    
}
