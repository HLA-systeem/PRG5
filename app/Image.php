<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function creator(){
        return $this->belongsTo('App\Project');
    }
}
