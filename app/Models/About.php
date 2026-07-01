<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'cta_button_text',
        'cta_button_url',
    ];

    protected $table = 'abouts';
}
