<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Badges extends Model
{
    use HasFactory;

    protected $table = 'badges';

    protected $fillable = [
        'name',
        'value'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'badge_user'); // Use 'badge_user' as the pivot table name
    }

    public static function getBadgesByValue($badge_value) {
        return self::where('value', '=', $badge_value)->first();
    }

}
