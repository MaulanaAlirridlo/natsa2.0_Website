<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vestige;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VestigeController extends Controller
{
    public function index()
    {
        $vestige = Vestige::orderBy('created_at', 'asc')->paginate(10);

        return view('admin.vestiges.vestige', [
            'vestiges' => $vestige,
        ]);
    }

    public function search(Request $request)
    {

        $search = Str::of($request->search)->trim();
        $sort = (!is_null($request->sort)) ? $request->sort : 'created_at';
        $order = (!is_null($request->order)) ? $request->order : 'asc';

        $vestige = Vestige::orderBy($sort, $order)
            ->where('vestige', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('admin.vestiges.vestige', [
            'vestiges' => $vestige,
        ]);
    }

    public function showStore()
    {
        return view('admin.vestiges.vestigeAdd');
    }

    public function showPut(Vestige $vestige)
    {
        return view('admin.vestiges.vestigePut', [
            'vestige' => $vestige,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'vestige' => 'required|max:150',
        ]);

        Vestige::create([
            'vestige' => $request->vestige,
        ]);

        return redirect()->route('admin.vestiges');

    }

    public function destroy(Vestige $vestige)
    {
        $vestige->where('id', $vestige->id)->delete();

        return redirect()->route('admin.vestiges');

    }

    public function put(Vestige $vestige, Request $request)
    {
        $this->validate($request, [
            'vestige' => 'required|max:150',
        ]);

        $vestige->where('id', $vestige->id)
            ->update([
                'vestige' => $request->vestige,
            ]);

        return redirect()->route('admin.vestiges');
    }
}
