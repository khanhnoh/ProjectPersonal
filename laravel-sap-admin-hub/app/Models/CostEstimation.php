<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CostEstimation extends Model
{
    protected $fillable = [
        'scope_id', 'hourly_rate', 'total_hours', 'labor_cost',
        'material_cost', 'markup_percentage', 'final_price', 'currency'
    ];

    public function scope(): BelongsTo
    {
        return $this->belongsTo(Scope::class);
    }

    public function calculateCosts(): void
    {
        $this->labor_cost = $this->total_hours * $this->hourly_rate;
        $markup = ($this->labor_cost * $this->markup_percentage) / 100;
        $this->final_price = $this->labor_cost + $this->material_cost + $markup;
    }
}
