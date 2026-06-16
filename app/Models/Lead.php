<?php
/**
 * Module: Lead & Scope Management (Module 1)
 * Feature: Lead model — customer profile, SAP scope matrix, pipeline status
 * Related: Scope, BANTAssessment
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lead extends Model
{
    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'company',
        'industry',
        'annual_revenue',
        'legacy_erp',
        'sap_modules',
        'deployment_type',
        'status',
        'description',
    ];

    protected $casts = [
        'sap_modules' => 'array',
    ];

    public function scopes(): HasMany
    {
        return $this->hasMany(Scope::class);
    }

    public function bantAssessment(): HasOne
    {
        return $this->hasOne(BANTAssessment::class);
    }
}
