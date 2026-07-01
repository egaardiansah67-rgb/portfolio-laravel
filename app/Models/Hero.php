<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profession',
        'description',
        'profile_image',
        'background_image',
        'cv_file',
        'button_hire_text',
        'button_cv_text',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (Hero::count() > 0) {
                throw new \Exception('Only one hero record allowed');
            }
        });
    }
}
