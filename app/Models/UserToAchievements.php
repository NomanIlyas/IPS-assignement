<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserToAchievements extends Model
{
    use HasFactory;

    protected $table = 'achievement_user';
    public $timestamps = false;
}
