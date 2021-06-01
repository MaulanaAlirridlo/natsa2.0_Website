<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index()
    {
        $region = Region::orderBy('created_at', 'asc')->paginate(10);

        return view('admin.regions.region', [
            'regions' => $region,
        ]);
    }

    public function search(Request $request)
    {

        $search = Str::of($request->search)->trim();
        $sort = (!is_null($request->sort)) ? $request->sort : 'created_at' ;
        $order = (!is_null($request->order)) ? $request->order : 'asc' ;

        $region = Region::orderBy($sort, $order)
            ->where('provinsi', 'LIKE', "%{$search}%")
            ->orWhere('kabupaten', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('admin.regions.region', [
            'regions' => $region,
        ]);
    }

    public function showStore()
    {
        return view('admin.regions.regionAdd');
    }

    public function showPut(Region $region)
    {
        return view('admin.regions.regionPut', [
            'region' => $region,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'provinsi' => 'required|max:100',
            'kabupaten' => 'required|max:100',
        ]);

        Region::create([
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
        ]);

        return redirect()->route('admin.regions');

    }

    public function destroy(Region $region)
    {
        $region->where('id', $region->id)->delete();

        return redirect()->route('admin.regions');

    }

    public function put(Region $region, Request $request)
    {
        $this->validate($request, [
            'provinsi' => 'required|max:100',
            'kabupaten' => 'required|max:100',
        ]);

        $region->where('id', $region->id)
            ->update([
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
            ]);

        return redirect()->route('admin.regions');
    }

}
