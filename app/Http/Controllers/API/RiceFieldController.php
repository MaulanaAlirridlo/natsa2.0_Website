<?php

namespace App\Http\Controllers\API;

use App\Models\RiceField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

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
                ->allowedFilters(['title','harga','luas','alamat',
                                    'sertifikasi','tipe','vestige_id',
                                    'irrigation_id','region_id',
                                    'verification_id'])
                ->defaultSort('-created_at')
                ->allowedSorts(['id','title','harga','luas'])
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
            'title' => 'required|max:150',
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

        $status = [
            "code" => 201,
            "message" => "Succes",
            "description" => "Sawah berhasil dibuat",
        ];

        $data = [
            "status" => $status,
            "riceField" => $riceField,
        ];

        //Untuk sementara tidak ada upload gambar
        // if ($request->hasFile('photo')) {
        //     //buat nama baru untuk fotonya
        //     $files = $request->file('photo');
        //     $i = 1;
        //     foreach ($files as $file) {
        //         $extension = $file->extension();
        //         $fileName = $riceField->id . '-' . $i . '-' . Str::random(20) . '.' . $extension;

        //         // simpan foto di server
        //         $file->storeAs('/riceFieldPhotos', $fileName, '');

        //         //simpan nama ke database
        //         RiceFieldPhoto::create([
        //             'rice_field_id' => $riceField->id,
        //             'photo_path' => 'riceFieldPhotos/' . $fileName,
        //         ]);

        //         $i++;
        //     }
        // }

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
        $riceField = RiceField::where('id', $id)->get();

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
            'title' => 'required|max:150',
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
                'user_id' => $request->pemilik,
                'vestige_id' => $request->vestige,
                'region_id' => $request->region,
                'irrigation_id' => $request->irrigation,
                'verification_id' => $request->verification,
            ]);

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
}
