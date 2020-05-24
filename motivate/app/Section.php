<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $casts = [ 'id' => 'integer', 'project_id' => 'integer' ];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}