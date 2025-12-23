<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'sections',
        'image_path',
        'video_url',
        'chapter',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sections' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($guide) {
            if (empty($guide->slug)) {
                $guide->slug = \Illuminate\Support\Str::slug($guide->title);
            }
        });

        static::updating(function ($guide) {
            if (empty($guide->slug)) {
                $guide->slug = \Illuminate\Support\Str::slug($guide->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
