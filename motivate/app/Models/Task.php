<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'task_description',
        'task_due',
        'task_completed',
        'completion_date',
        'task_priority',
        'task_progress_weight',
        'section_id',
    
    ];
    
    
    protected $dates = [
        'task_due',
        'completion_date',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/tasks/'.$this->getKey());
    }
}
