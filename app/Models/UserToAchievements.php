<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder as Builder;

class UserToAchievements extends Model
{
    use HasFactory;

    protected $table = 'achievement_user';
    public $timestamps = false;

    public static function create(array $attributes = []): Builder
    {
        return static::query()->create($attributes);
    }
}
