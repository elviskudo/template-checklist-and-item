<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $casts = ['deleted_at' => 'string'];
    protected $fillable = [
        'object_domain',
        'object_id',
        'description',
        'is_completed',
        'due',
        'urgency',
        'completed_at',
        'last_updated_by',
    ];
}
