<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scope extends Model
{
    protected $fillable = ['lead_id', 'scope_title', 'description', 'estimated_duration', 'status'];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function effortEstimations(): HasMany
    {
        return $this->hasMany(EffortEstimation::class);
    }

    public function costEstimation()
    {
        return $this->hasOne(CostEstimation::class);
    }

    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    public function artifacts(): HasMany
    {
        return $this->hasMany(Artifact::class);
    }

    public function pitchingChecklists(): HasMany
    {
        return $this->hasMany(PitchingChecklist::class);
    }
}
