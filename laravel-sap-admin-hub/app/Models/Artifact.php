<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artifact extends Model
{
    protected $fillable = ['scope_id', 'artifact_name', 'description', 'file_path', 'file_type', 'uploaded_by', 'upload_date'];
    protected $casts = ['upload_date' => 'datetime'];

    public function scope(): BelongsTo
    {
        return $this->belongsTo(Scope::class);
    }
}
