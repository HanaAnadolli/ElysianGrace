<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\ContactForm;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCount = User::where('role', 'user')->count();
        $contactCount = ContactForm::where('created_at', '>=', now()->subDay())->count(); // Contacts in last 24 hours
        $reservedRoomsCount = Room::where('status', 'reserved')->count();
    
        // Fetch available rooms
        $availableRooms = Room::where('status', 'available')->get();
    
        // Prepare monthly data
        $months = [];
        $userCounts = [];
    
        for ($i = 1; $i <= 12; $i++) {
            $months[] = \Carbon\Carbon::create()->month($i)->format('F');
            $userCounts[] = User::whereYear('created_at', date('Y'))
                                ->whereMonth('created_at', $i)
                                ->count();
        }
    
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'contactCount' => $contactCount,
            'reservedRoomsCount' => $reservedRoomsCount,
            'availableRooms' => $availableRooms, // Pass available rooms to the view
            'months' => $months,
            'userCounts' => $userCounts,
        ]);
    }
    


    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
