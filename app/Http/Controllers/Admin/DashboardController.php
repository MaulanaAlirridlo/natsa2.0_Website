<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\RiceField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(){
        $user = User::where('role', 'user');

        $users = $user->limit(10)->where('role', 'user')->get();
        $userTotal = $user->count();

        $riceField = RiceField::all();

        return view('admin.dashboard', [
            'users' => $users,
            'userTotal' => $userTotal,
            'riceField' => $riceField,
        ]);
    }

}
