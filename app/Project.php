<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{

    protected $fillable = [
        'title', 'body', 'times_viewed', 'tags'
    ];

    public function creator(){
        return $this->belongsTo('App\User', 'creator_id');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function tags(){
        return $this->hasMany('App\Tag');
    }
}
