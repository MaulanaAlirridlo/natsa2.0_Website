<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('created_at', 'asc')->paginate(10);

        return view('admin.users.user', [
            'users' => $user,
        ]);
    }

    public function search(Request $request)
    {

        $search = Str::of($request->search)->trim();
        $sort = (!is_null($request->sort)) ? $request->sort : 'created_at';
        $order = (!is_null($request->order)) ? $request->order : 'asc';

        $user = User::orderBy($sort, $order)
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('role', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('admin.users.user', [
            'users' => $user,
        ]);
    }

    public function showStore()
    {
        return view('admin.users.userAdd');
    }

    public function showPut(User $user)
    {
        return view('admin.users.userPut', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:150',
            'email' => 'required|max:150',
            'password' => 'required|max:150|confirmed',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,

        ]);

        return redirect()->route('admin.users');

    }

    public function destroy(User $user)
    {
        $user->where('id', $user->id)->delete();

        return redirect()->route('admin.users');

    }

    public function put(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'email' => 'required|max:150',
            'role' => 'required',
        ]);

        $user->where('id', $user->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);

        return redirect()->route('admin.users');
    }
}
