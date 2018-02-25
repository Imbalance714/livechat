<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Room
 *
 * @package App
 *
 * @property integer id
 * @property Carbon  created_at
 * @property Carbon  updated_at
 */
class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name',
    ];
}
