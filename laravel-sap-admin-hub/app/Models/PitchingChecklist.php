<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PitchingChecklist extends Model
{
    protected $fillable = ['scope_id', 'checklist_item', 'is_completed', 'assigned_to', 'due_date', 'notes'];
    protected $casts = ['due_date' => 'date', 'is_completed' => 'boolean'];

    public function scope(): BelongsTo
    {
        return $this->belongsTo(Scope::class);
    }
}
