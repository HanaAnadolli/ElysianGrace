<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $rooms = Room::all();

        return response()->json($rooms);
    }

    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        return response()->json($room);
    }

    public function getRandomRooms()
    {
        // Example logic to fetch random rooms
        $rooms = Room::inRandomOrder()->limit(3)->get();
        return response()->json($rooms);
    }
}
