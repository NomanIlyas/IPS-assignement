<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserToBadges extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'badge_user';
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param array $attributes
     * @return Builder
     */
    public static function create(array $attributes = []): Builder
    {
        return static::query()->create($attributes);
    }
}
