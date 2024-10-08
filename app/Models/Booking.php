<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'comments',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
