<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['project_id', 'url'];

    public function project(){
        return $this->belongsTo('App\Project');
    }
}
