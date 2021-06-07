<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RiceField;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $riceFields = RiceField::limit(5)->select('id', 'title', 'harga')->get();
        $latestRiceFields = RiceField::limit(5)->select('id', 'title', 'harga')->orderBy('created_at', 'desc')->get();

        return view('user.index', [
            'riceFields' => $riceFields,
            'latestRiceFields' => $latestRiceFields,
        ]);
    }
}
