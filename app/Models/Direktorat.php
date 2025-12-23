<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direktorat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all units in this direktorat
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Get all active units
     */
    public function activeUnits()
    {
        return $this->hasMany(Unit::class)->where('is_active', true);
    }
}
