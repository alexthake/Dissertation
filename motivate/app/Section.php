<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $casts = [ 'id' => 'integer', 'project_id' => 'integer' ];
}