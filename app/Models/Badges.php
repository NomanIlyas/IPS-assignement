<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badges extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'badges';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'value'
    ];

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'badge_user');
    }

    /**
     * @param $badge_value
     * @return mixed
     */
    public static function getBadgesByValue($badge_value): mixed
    {
        return self::where('value', '=', $badge_value)->first();
    }

}
