<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $primaryKey = 'tweet_id';

    public function user()
    {
        return $this->belongsTo(Account::class);
    }
}
