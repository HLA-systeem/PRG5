<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{

    protected $fillable = [
        'title', 'body', 'times_viewed', 'tags'
    ];

    public function creator(){
        return $this->belongsTo('App\User');
    }

    public function imagess(){
        return $this->hasMany('App\Image');
    }
}
