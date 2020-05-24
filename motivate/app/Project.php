<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}