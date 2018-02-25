<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chat
 *
 * @package App
 *
 * @property integer id
 * @property Carbon  created_at
 * @property Carbon  updated_at
 */
class Chat extends Model
{
    protected $table = 'chat';

    protected $fillable = [
        'user_id',
        'room_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
