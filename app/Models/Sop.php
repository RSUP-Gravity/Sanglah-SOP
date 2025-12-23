<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'unit_id',
        'title',
        'code',
        'category',
        'description',
        'file_path',
        'file_name',
        'file_size',
        'effective_date',
        'review_date',
        'status',
        'version',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'effective_date' => 'date',
        'review_date' => 'date',
        'file_size' => 'integer',
    ];

    /**
     * Get the unit that owns the SOP
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the user who created the SOP
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the SOP
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get all versions of this SOP
     */
    public function versions()
    {
        return $this->hasMany(SopVersion::class);
    }

    /**
     * Get all validations for this SOP
     */
    public function validations()
    {
        return $this->hasMany(Validation::class);
    }

    /**
     * Get the latest validation
     */
    public function latestValidation()
    {
        return $this->hasOne(Validation::class)->latestOfMany();
    }

    /**
     * Get all activity logs for this SOP
     */
    public function activities()
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }

    /**
     * Scope for active SOPs
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for pending SOPs
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending_validation');
    }
}
