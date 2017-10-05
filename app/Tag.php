<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model{
    protected $fillable = ['project_id', 'name'];
    
    public function creator(){
        return $this->belongsTo('App\Project');
    }
    
}
