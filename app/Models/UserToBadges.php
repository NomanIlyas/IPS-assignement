<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserToBadges extends Model
{
    use HasFactory;
    protected $table = 'badges_user';
    public $timestamps = false;
}
