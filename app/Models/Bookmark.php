<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'rice_field_id', 'user_id',
    ];

    public function ownBy(User $user){
        return $user->id === $this->user_id;
    }

}
