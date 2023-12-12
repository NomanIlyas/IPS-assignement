<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'achievements';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
        'value'
    ];
}
