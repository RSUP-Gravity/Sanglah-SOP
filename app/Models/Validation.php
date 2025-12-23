<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $fillable = [
        'sop_id',
        'validator_id',
        'status',
        'notes',
        'validated_at',
    ];

    protected $casts = [
        'validated_at' => 'datetime',
    ];

    /**
     * Get the SOP being validated
     */
    public function sop()
    {
        return $this->belongsTo(Sop::class);
    }

    /**
     * Get the validator user
     */
    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }

    /**
     * Scope for approved validations
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for rejected validations
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope for pending validations
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
