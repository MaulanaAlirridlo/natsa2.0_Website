<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiceFieldPhotoUploadController extends Controller
{
    public function store(Request $request)
    {

        if ($request->hasFile('photo')) {
            $files = $request->file('photo');
            $i = 1;
            $newFileName = "";
            // $folder = uniqid() . '-' . now()->timestamp;

            foreach($files as $file){
                $fileExt = $file->extension();
                $newFileName = Str::random(20) . '.' . $fileExt;
                // $newFileName = $file->getClientOriginalName(); //get original name
    
                $file->storeAs('riceFieldPhotos/temps/', $newFileName);

                $i++;
            }

            return $newFileName;
        }

        return '';

    }

    public function destroy(Request $request)
    {

        $file = $request->getContent();

        Storage::delete('riceFieldPhotos/temps/' . $file);

        return $file;

    }
}
