<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    /**
     * Display a listing of the available rooms.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Fetch rooms where status is 'available'
        $rooms = Room::where('status', 'available')->get();

        return response()->json($rooms);
    }

    /**
     * Display the details of a specific room.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        // Fetch the room by ID and ensure it is available
        $room = Room::where('id', $id)->where('status', 'available')->first();

        if (!$room) {
            return response()->json(['message' => 'Room not found or not available'], 404);
        }

        return response()->json($room);
    }

    /**
     * Display a list of random available rooms.
     *
     * @return JsonResponse
     */
    public function getRandomRooms(): JsonResponse
    {
        // Fetch random rooms where status is 'available'
        $rooms = Room::where('status', 'available')->inRandomOrder()->limit(3)->get();
        
        return response()->json($rooms);
    }
}
