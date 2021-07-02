<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Models\UserSocialMedia;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Actions\Fortify\PasswordValidationRules;

class ProfileController extends Controller
{
    
    use PasswordValidationRules;
    
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(){

        $socialMedias = SocialMedia::select('id', 'sosmed')->get();
        $userSocialMedias = UserSocialMedia::where('user_id', auth()->user()->id)
            ->with('socialMedia')    
            ->get();

        // return $userSocialMedias;
        return view('user.profile.profile', [
            'socialMedias' => $socialMedias,
            'userSocialMedias' => $userSocialMedias,
        ]);


    }

    public function updateProfile(Request $request){

        $this->validate($request, [
            'name' => ['required', 'string', 'max:150', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:150', Rule::unique('users')->ignore(auth()->user()->id)],
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore(auth()->user()->id), 'alpha_dash'],
            'ktp' => ['required', 'numeric', 'digits:16', Rule::unique('users')->ignore(auth()->user()->id)],
            'nohp' => ['numeric', 'digits_between:12,13'],
        ]);

        $update = auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'ktp' => $request->ktp,
            'no_hp' => $request->nohp,
        ]);

        $files = $request->photo;
        $i = 1;
        foreach ($files as $file) {
            if($file != null){

                $newFileName = auth()->user()->id . '-' . $file;
    
                // pindah foto ke storage/riceFields
                Storage::move('riceFieldPhotos/temps/'.$file, 'profile-photos/'.$newFileName);
    
                //simpan nama ke database
                auth()->user()->update([
                    'profile_photo_path' => 'profile-photos/'.$newFileName,
                ]);
    
                $i++;
            }
        }

        if(!$update){
            return back()->with('error', 'Wow kok ada yang salah');
        }
        
        return back()->with('success', 'Berhasil');
        
    }

    public function updatePassword(Request $request){

        $this->validate($request, [
            'current_password' => ['required','max:13', new MatchOldPassword],
            'password' => $this->passwordRules(),
        ]);

        $update = auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        if(!$update){
            return back()->with('error', 'Wow kok ada yang salah');
        }

        return back()->with('succes', 'Berhasil');

    }

    public function destroy(){

        auth()->user()->delete();

        return redirect()->route('home');

    }

}
