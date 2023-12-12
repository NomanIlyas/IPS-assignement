<?php

namespace App\Services;

use App\Models\Achievement;

class AchievementService
{
    public static function getAchievementByValueAndType($value, $type)
    {
        return Achievement::where('value', '=', $value)->where('type', '=', $type)->first();
    }

    public static function getBadgesByValue($value)
    {
        return Badges::where('value', '=', $value)->first();
    }
}
