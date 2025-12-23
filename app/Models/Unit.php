<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'direktorat_id',
        'name',
        'code',
        'description',
    ];

    /**
     * Get the direktorat that owns the unit
     */
    public function direktorat()
    {
        return $this->belongsTo(Direktorat::class);
    }

    /**
     * Get all users in this unit
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all SOPs from this unit
     */
    public function sops()
    {
        return $this->hasMany(Sop::class);
    }
}
