<?php

namespace App\Http\Controllers\API;

use App\Models\RiceField;
use App\Models\UserHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RiceFieldPhoto;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;

class RiceFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riceField = QueryBuilder::for(RiceField::class) 
                ->allowedFilters(['id', 'title', 'harga', 'user_id', 'ketersediaan'])
                ->select('id', 'title', 'harga', 'user_id')
                ->with('photo')
                ->defaultSort('-created_at')
                ->allowedSorts(['id','title','harga'])
                ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($riceField->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "riceField" => $riceField,
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
            'photo.*' => ["required", "mimes:png,jpg,jpeg", "max:512"]
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
        

        $status = [
            "code" => 201,
            "message" => "Succes",
            "description" => "Sawah berhasil dibuat",
        ];

        $data = [
            "status" => $status,
            "riceField" => $riceField,
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
        $riceField = RiceField::where('id', $id)
            ->with(['user', 'vestige', 'irrigation',
                'region', 'photo'])
            ->firstOrfail();

        //record bahwa sawah dilihat
        views($riceField)->record();

        return views($riceField)->count();

        //simpan sawah di history jika login
        if(auth()->user()){

            $isItThere = UserHistory::where('user_id', auth()->user()->id)
                ->where('rice_field_id', $id)->first();
    
            $userHistoryTotal = UserHistory::where('user_id', auth()->user()->id)
                ->get()->count();
            
            //simpan sawah kalau belum ada
            if(!$isItThere){
    
                //Hapus history terakhir jika history lebih dari 10
                if($userHistoryTotal >= 10){
                    UserHistory::where('user_id', auth()->user()->id)
                        ->orderBy('id', 'desc')->first()->delete();
                }
    
                UserHistory::create([
                    "user_id" => auth()->user()->id,
                    "rice_field_id" => $id,
                ]);
                
            }
            
        }

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($riceField->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data show",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "riceField" => $riceField,
        ];

        return response()->json($data);
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
            'photo.*' => ["mimes:png,jpg,jpeg", "max:512"]
        ]);

        $riceField = RiceField::where('id', $id)
            ->update([
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

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Sawah berhasil diupdate",
        ];

        $data = [
            "status" => $status,
            "riceField" => $riceField,
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
        $riceField = RiceField::where('id', $id)->delete();

        $status = [
            "code" => 204,
            "message" => "Succes",
            "description" => "Sawah berhasil dihapus",
        ];

        $data = [
            "status" => $status,
            "riceField" => $riceField,
        ];

        return response()->json($data);
    }

    public function search($search){
        
        $riceField = QueryBuilder::for(RiceField::class) 
                ->allowedFilters(['id', 'title', 'harga'])
                ->select(
                    'id', 
                    'title', 
                    'harga',
                    DB::raw("(SELECT CONCAT(regions.provinsi, ', ', regions.kabupaten) from 
                    regions where regions.id = rice_fields.region_id) as regions"), )
                ->havingRaw("regions LIKE '%{$search}%'")
                ->where('ketersediaan', '1')
                ->with('photo')
                ->defaultSort('-created_at')
                ->allowedSorts(['id','title','harga'])
                ->paginate(20);

        // $riceField = RiceField::select(
        //     'id', 
        //     'title', 
        //     'harga',
        //     DB::raw("(SELECT CONCAT(regions.provinsi, ', ', regions.kabupaten) from 
        //     regions where regions.id = rice_fields.region_id) as regions"), )
        //     ->with('photo')
        //     ->havingRaw("regions LIKE '%{$search}%'")
        //     ->paginate(20);
        
        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($riceField->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data show",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "riceField" => $riceField,
        ];

        return response()->json($data);
    }

    public function product($id){
        $riceField = RiceField::with('photos')
            ->where('id', $id)->firstOrfail();

        $randomRiceFields = RiceField::select('id', 'title', 'harga')
            ->where('ketersediaan', '1')
            ->with('photo')
            ->limit(4)
            ->inRandomOrder()->get();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($riceField->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data show",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "riceField" => $riceField,
            "randomRiceFields" => $randomRiceFields,
        ];

        return response()->json($data);
    }

    public function updateKetersediaan($id)
    {
        $riceField = RiceField::where('id', $id)->first();

        if(auth()->user()->id != $riceField->user_id){
            $status = [
                "code" => 403,
                "message" => "Forbidden",
                "description" => "Sawah bukan milik pengguna yang sedang login",
            ];

            return response()->json(["status" => $status]);

        }

        $ketersediaan = "1";
        if($riceField->ketersediaan == 1){
            $ketersediaan = "0";
        }

        $update = RiceField::where('id', $id)->where('id', $riceField->id)
            ->update(['ketersediaan' => $ketersediaan]);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Sawah berhasil diupdate",
        ];

        $data = [
            "status" => $status,
            "riceField" => $update,
        ];

        return response()->json($data);

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
        
        $status = [
            "code" => 204,
            "message" => "Succes",
            "description" => "Foto berhasil dihapus",
        ];

        $data = [
            "status" => $status,
            "riceField" => $riceField,
        ];

        return response()->json($data);

    }

}
