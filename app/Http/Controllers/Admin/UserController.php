<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $this->validate($request, [
            'search' => ['max:100','regex:/^[\pL\s\-]+$/u'],
        ]);

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
            'name' => ['required', 'string', 'max:150', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'username' => ['required', 'string', 'max:50', 'unique:users', 'alpha_dash'],
            'ktp' => ['required', 'numeric', 'digits:16', 'unique:users'],
            'password' => ['required','max:13','confirmed'],
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'ktp' => $request->ktp,
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
        // return $user;
        $data = $request->toArray();

        $this->validate($request, [
            'name' => ['required', 'string', 'max:150', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:150', Rule::unique('users')->ignore($user->id)],
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id), 'alpha_dash'],
            'ktp' => ['required', 'numeric', 'digits:16', Rule::unique('users')->ignore($user->id)],
            'role' => 'required',
        ]);

        $user->where('id', $user->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'ktp' => $request->ktp,
                'role' => $request->role,
            ]);

        return redirect()->route('admin.users');
    }
}
