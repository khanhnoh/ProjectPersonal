<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    protected $fillable = ['customer_name', 'email', 'phone', 'company', 'status', 'description'];

    public function scopes(): HasMany
    {
        return $this->hasMany(Scope::class);
    }

    public function bantAssessment()
    {
        return $this->hasOne(BANTAssessment::class);
    }
}
