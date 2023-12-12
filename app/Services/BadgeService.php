<?php

namespace App\Services;

use App\Models\Badges;

class BadgeService
{
    public static function getBadgesByValue($value)
    {
        return Badges::where('value', '=', $value)->first();
    }
}
