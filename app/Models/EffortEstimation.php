<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EffortEstimation extends Model
{
    protected $fillable = ['scope_id', 'task_name', 'estimated_hours', 'assigned_to', 'status'];

    public function scope(): BelongsTo
    {
        return $this->belongsTo(Scope::class);
    }
}
