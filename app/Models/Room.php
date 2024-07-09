<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'check_in_info',
        'check_out_info',
        'house_rules',
        'children_extra_beds_info',
        'image',
        'selected_in_date',
        'selected_out_date',
        'adults',
        'children',
        'rooms',
        'amenities',
        'status',
        'price',
    ];

    protected $casts = [
        'selected_in_date' => 'date',
        'selected_out_date' => 'date',
        'amenities' => 'array',
    ];
    
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
