<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RiceField;

class HomeController extends Controller
{
    public function index()
    {

        // $riceFields = RiceField::select('id', 'title', 'harga')
        //     ->with('photo')
        //     ->limit(4)->get();

        $latestRiceFields = RiceField::select('id', 'title', 'harga')
            ->where('ketersediaan', '1')
            ->with('photo')
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();

        $popularRiceFields = RiceField::select('id', 'title', 'harga')
            ->where('ketersediaan', '1')
            ->with('photo')
            ->orderByViews()
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();

        $popularSellRiceFields = RiceField::select('id', 'title', 'harga')
            ->where('tipe', 'jual')
            ->where('ketersediaan', '1')
            ->with('photo')
            ->orderByViews()
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();

        $popularRentRiceFields = RiceField::select('id', 'title', 'harga')
            ->where('tipe', 'sewa')
            ->where('ketersediaan', '1')
            ->with('photo')
            ->orderByViews()
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();

        // return $popularRentRiceFields;

        return view('user.index', [
            'latestRiceFields' => $latestRiceFields,
            'popularRiceFields' => $popularRiceFields,
            'popularSellRiceFields' => $popularSellRiceFields,
            'popularRentRiceFields' => $popularRentRiceFields,
        ]);
    }
}
