<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RiceField;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        // $riceFields = RiceField::select('id', 'title', 'harga')
        //     ->with('photo')
        //     ->limit(4)->get();

        $latestRiceFields = RiceField::select('id', 'title', 'harga')
            ->with('photo')
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();

        // return $latestRiceFields;

        return view('user.index', [
            'latestRiceFields' => $latestRiceFields,
        ]);
    }
}
