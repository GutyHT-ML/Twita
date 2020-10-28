<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    protected $fillable = ['user_id', 'abilities'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
