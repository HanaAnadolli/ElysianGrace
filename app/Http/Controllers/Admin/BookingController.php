<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\DataTables\BookingsDataTable;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BookingsDataTable $dataTable)
    {
        return $dataTable->render('admin.bookings.index');
    }

    public function approve($id)
    {
        $booking = Booking::find($id);
    
        if ($booking) {
            // Update booking status
            $booking->status = 'approved';
            $booking->save();
    
            $room = Room::find($booking->room_id); 
            if ($room) {
                $room->status = 'reserved'; 
                $room->save();
            }
    
            return response()->json(['success' => true, 'message' => 'Booking approved and room status updated to reserved.']);
        }
    
        return response()->json(['success' => false, 'message' => 'Booking not found.']);
    }
    
    public function reject($id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->status = 'rejected'; 
            $booking->save();
            return response()->json(['success' => true, 'message' => 'Booking rejected successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Booking not found.']);
    }
    
}
