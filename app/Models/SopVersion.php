<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SopVersion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sop_id',
        'version_number',
        'file_path',
        'file_name',
        'file_size',
        'changes_description',
        'created_by',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Get the SOP that owns this version
     */
    public function sop()
    {
        return $this->belongsTo(Sop::class);
    }

    /**
     * Get the user who created this version
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
