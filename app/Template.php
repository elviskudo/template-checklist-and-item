<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $casts = ['deleted_at' => 'string'];
    protected $fillable = [
        'name',
        'checklist_id',
        'item_id',
    ];
}
