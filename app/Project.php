<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function creator(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'title', 'body'
    ];
}
