<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [ 'id' => 'integer', 'section_id' => 'integer' ];
}