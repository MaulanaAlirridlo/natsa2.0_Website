<?php

namespace App\Models;

use App\Models\RiceField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiceFieldPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'rice_field_id',
        'photo_path',
    ];

    public function riceField(){
        return $this->belongsTo(RiceField::class);
    }
}
