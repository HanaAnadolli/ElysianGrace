<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'working_hours',
        'rules',
    ];

    protected $casts = [
        'working_hours' => 'array',
        'rules' => 'array',
    ];
}