<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'name',
        'type',
        'value'
    ];

    public static function getTypes()
    {
        return config('achievements.types');
    }

    public function getAchievementIdByName($achievement_name)
    {
        return
            self::where('name', '=', $achievement_name)->first()->id;
    }

    public static function getAchievementByValueAndType($achievement_value, $type)
    {
        return
            self::where(['value' => $achievement_value, 'type' => $type])->first()->name;
    }
}
