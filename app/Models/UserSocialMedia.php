<?php

namespace App\Models;

use App\Models\User;
use App\Models\SocialMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_media_id', 'link', 'user_id'
    ]; 

    /**
     * Get the user that owns the UserSocialMedia
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
