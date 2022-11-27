<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowerRelationship extends Model
{
    use HasFactory;

    protected $table = 'follower_relationships';

    public $timestamps   = false;
    public $incrementing = false;
}
