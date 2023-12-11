<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserToBadges extends Model
{
    use HasFactory;
    protected $table = 'badge_user';
    public $timestamps = false;

    public static function create($attributes = []): Builder
    {
        return static::query()->create($attributes);
    }
}
