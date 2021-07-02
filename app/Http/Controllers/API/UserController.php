<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;
use App\Actions\Fortify\PasswordValidationRules;

class UserController extends Controller
{
    use PasswordValidationRules;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = QueryBuilder::for(User::class) 
                ->allowedFilters(['name','email','role'])
                ->defaultSort('-created_at')
                ->allowedSorts(['id', 'email', 'name', 'created_at'])
                ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($users->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data index",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "users" => $users,
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('id', $id)
            ->where('role', 'user')->get();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($users->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data show",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "users" => $users,
        ];

        return response()->json($data);
    }

    public function do(Request $request){
        return $request;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $this->validate($request, [
            'name' => ['required', 'string', 'max:150', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:150', Rule::unique('users')->ignore(auth()->user()->id)],
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore(auth()->user()->id), 'alpha_dash'],
            'ktp' => ['required', 'numeric', 'digits:16', Rule::unique('users')->ignore(auth()->user()->id)],
            'no_hp' => ['numeric', 'digits_between:12,13'],
            'photo' => ["mimes:png,jpg,jpeg", "max:512"]
        ]);

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'ktp' => $request->ktp,
            'no_hp' => $request->no_hp,
        ]);
        
        if ($request->hasFile('photo')) {
            
            //buat nama untuk fotonya
            $file = $request->file('photo');
            $extension = $file->extension();
            $newFileName = auth()->user()->id . '-' . '-' . Str::random(20) . '.' . $extension;
            
            // pindah foto ke storage/riceFields
            $file->storeAs('profile-photos/'.$newFileName, '');
            
            //simpan nama ke database
            auth()->user()->update([
                'profile_photo_path' => 'profile-photos/'.$newFileName,
            ]);
            
        }
        
        $user = auth()->user();

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diupdate",
        ];

        $data = [
            "status" => $status,
            "user" => $user,
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
    public function updatePassword(Request $request)
    {
        
        $this->validate($request, [
            'current_password' => ['required','max:13', new MatchOldPassword],
            'password' => $this->passwordRules(),
        ]);

        $update = auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        $status = [
            "code" => 204,
            "message" => "Fail",
            "description" => "There is something wrong, i can feel it",
        ];
        
        if($update){
            $status = [
                "code" => 200,
                "message" => "Succes",
                "description" => "Password berhasil diubah, silahkan login kembali",
            ];

            auth()->user()->tokens()->delete();
        }

        $data = [
            "status" => $status,
            "user" => $update,
        ];

        return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->user()->tokens()->delete();

        // $user->delete();
        auth()->user()->delete();

        return[
            'message' => "User deleted",
        ];

    }

    /**
     * Menampilkan data yang mirip
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {
        $search = Str::of($search)->trim();

        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['name','email','role'])
            ->defaultSort('-created_at')
            ->allowedSorts(['id', 'email', 'name', 'created_at'])
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('role', 'LIKE', "%{$search}%")
            ->paginate(10);

        $status = [
            "code" => 200,
            "message" => "Succes",
            "description" => "Data berhasil diambil",
        ];

        if ($users->count() <= 0) {
            $status = [
                "code" => 200,
                "message" => "Succes, No Data search",
                "description" => "Server merespon, tetapi tidak ada data untuk dikembalikan",
            ];
        }

        $data = [
            "status" => $status,
            "users" => $users,
        ];

        return response()->json($data);
    }

    public function details(){
        $user = auth()->user();

        return response()->json(['user' => $user]);
    }
}
