<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $casts = ['deleted_at' => 'string'];
    protected $fillable = [
        'description',
        'is_completed',
        'completed_at',
        'completed_by',
        'due',
        'due_interval',
        'due_unit',
        'urgency',
        'created_by',
        'updated_by',
        'checklist_id',
        'assignee_id',
        'task_id',
    ];
}
