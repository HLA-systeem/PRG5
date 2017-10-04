<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['project_id', 'url'];

    public function creator(){
        return $this->belongsTo('App\Project');
    }
}
