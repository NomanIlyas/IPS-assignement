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
}
