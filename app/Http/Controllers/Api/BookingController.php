<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; 
use App\Models\Room; 

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'comments' => 'nullable|string',
        ]);

        // Create the booking with a default status of 'pending'
        $booking = Booking::create([
            'room_id' => $request->room_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comments' => $request->comments,
            'status' => 'pending', // Default status
        ]);

        return response()->json($booking, 201);
    }

}