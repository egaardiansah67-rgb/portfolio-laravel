<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorAnalytic extends Model
{
    protected $fillable = [
        'visit_date',
        'visitor_count',
        'page_views',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'visitor_count' => 'integer',
        'page_views' => 'integer',
    ];
}
