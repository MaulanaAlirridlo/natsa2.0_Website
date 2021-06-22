<?php

namespace App\Models;

use App\Models\User;
use App\Models\Region;
use App\Models\Vestige;
use App\Models\Bookmark;
use App\Models\RiceField;
use App\Models\Irrigation;
use App\Models\Verification;
use App\Models\RiceFieldPhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class RiceField extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;

    protected $fillable = [
        'title',
        'harga',
        'luas',
        'alamat',
        'maps',
        'deskripsi',
        'sertifikasi',
        'tipe',
        'user_id',
        'vestige_id',
        'irrigation_id',
        'region_id',
    ];

    //relasi user dan riceField
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relasi vestige dan riceField
    public function vestige()
    {
        return $this->belongsTo(Vestige::class);
    }

    //relasi irrigation dan riceField
    public function irrigation()
    {
        return $this->belongsTo(Irrigation::class);
    }

    //relasi region dan riceField
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    //relasi region dan riceField
    public function verification()
    {
        return $this->belongsTo(Verification::class);
    }

    //mengambil semua foto
    public function photos(){
        return $this->hasMany(RiceFieldPhoto::class);
    }

    //mengambil satu foto sajah
    public function photo(){
        return $this->hasOne(RiceFieldPhoto::class);
    }

    //untuk menyimpan bookmark
    public function bookmark(){
        return $this->hasMany(Bookmark::class);
    }

    //sudah bookmarked
    public function bookmarkedBy(User $user){
        return $this->bookmark->contains('user_id', $user->id);
    }

    /*
    untuk api
    */
    public function getPemilikAttribute()
    {
        return User::where('id', $this->user_id)->get();
    }

    public function getVestigeAttribute()
    {
        $vestiges = Vestige::where('id', $this->vestige_id)
            ->select('vestige')
            ->pluck('vestige');
        return $vestiges[0];
    }

    public function getIrrigationAttribute()
    {
        $irrigation = Irrigation::where('id', $this->irrigation_id  )
            ->select('irrigation')
            ->pluck('irrigation');
        return $irrigation[0];
    }

    public function getRegionAttribute()
    {
        $region = Region::where('id', $this->region_id);
        $provinsi = $region->select('provinsi')->pluck('provinsi');
        $kabupaten = $region->select('kabupaten')->pluck('kabupaten');
        return $provinsi[0]. ", " . $kabupaten[0];
    }

    public function getVerificationAttribute()
    {
        $verification = Verification::where('id', $this->verification_id  )
            ->select('verification_type')
            ->pluck('verification_type');
        return $verification[0];
    }
}
