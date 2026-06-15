<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResourceAllocation extends Model
{
    protected $fillable = ['timeline_id', 'resource_name', 'role', 'allocation_percentage', 'start_date', 'end_date', 'notes'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function timeline(): BelongsTo
    {
        return $this->belongsTo(Timeline::class);
    }
}
