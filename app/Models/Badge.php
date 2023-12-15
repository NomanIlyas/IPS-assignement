<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Badge extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'badge';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'value'
    ];

    /**
     * @param $badge_value
     * @return mixed
     */
    public static function getBadgesByValue($badge_value): mixed
    {
        return self::where('value', '=', $badge_value)->first();
    }

}
