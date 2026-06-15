<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BANTAssessment extends Model
{
    protected $table = 'bant_assessments';
    protected $fillable = [
        'lead_id', 'budget_score', 'authority_score', 'need_score', 'timeline_score',
        'budget_notes', 'authority_notes', 'need_notes', 'timeline_notes',
        'overall_score', 'recommendation'
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function calculateOverallScore(): void
    {
        $this->overall_score = (int) (($this->budget_score + $this->authority_score +
                                      $this->need_score + $this->timeline_score) / 4);
    }
}
