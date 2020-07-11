<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = [
        'actived',
    ];
    //
    public function writer()
    {
       return $this->belongsTo('App\User', 'author', 'id');
    }
}
