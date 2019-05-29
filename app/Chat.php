<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
