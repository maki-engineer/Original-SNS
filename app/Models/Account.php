<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function follows()
    {
        return $this->belongsTo(User::class, 'follower_relationships', 'follower_id', 'user_id');
    }

    public function followers()
    {
        return $this->belongsTo(User::class, 'follower_relationships', 'user_id', 'follower_id');
    }
}
