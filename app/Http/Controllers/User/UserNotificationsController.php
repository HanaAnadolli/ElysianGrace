<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Offer;
use Carbon\Carbon;

class UserNotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function notifications(Request $request)
    {
        $user = Auth::user();
    
        if ($user) {
            $today = Carbon::now()->startOfDay();
            $currentMonth = $today->month;
            $currentYear = $today->year;
    
            // Fetch booking notifications
            $bookings = Booking::where('email', $user->email)
                ->with('room')
                ->get()
                ->map(function ($booking) use ($today) {
                    $checkInDate = Carbon::parse($booking->room->selected_in_date)->startOfDay();
                    $daysLeft = $checkInDate->diffInDays($today, false);
    
                    $notificationMessage = "";
                    $isPast = false;
    
                    if ($today->greaterThan($checkInDate)) {
                        $notificationMessage = "Your booking has passed and is not available.";
                        $isPast = true;
                    } elseif ($daysLeft === 1) {
                        $notificationMessage = "Tomorrow is your booking!";
                    } elseif ($daysLeft === 0) {
                        $notificationMessage = "Your booking is today!";
                    } else {
                        $notificationMessage = "{$daysLeft} days left until your booking.";
                    }
    
                    return [
                        'type' => 'booking',
                        'room_name' => $booking->room->title,
                        'check_in_date' => $checkInDate->format('Y-m-d'),
                        'notification' => $notificationMessage,
                        'is_past' => $isPast,
                    ];
                });
    
            // Fetch offer notifications for the current month
            $offers = Offer::whereMonth('start_date', '=', $currentMonth)
                ->whereYear('start_date', '=', $currentYear)
                ->whereDate('end_date', '>=', $today)
                ->get()
                ->map(function ($offer) use ($today) {
                    $endDate = Carbon::parse($offer->end_date)->endOfDay();
                    $daysLeft = $endDate->diffInDays($today, false);
    
                    $notificationMessage = "";
                    $isPast = false;
    
                    if ($endDate->isToday()) {
                        $notificationMessage = "Today's the last day to use the offer!";
                    } elseif ($today->greaterThan($endDate)) {
                        $notificationMessage = "The offer has ended.";
                        $isPast = true;
                    } else {
                        // Ensure we use absolute value to avoid negative days
                        $daysLeft = $today->diffInDays($endDate, false);
                        $notificationMessage = "{$daysLeft} days left for the offer.";
                    }
    
                    return [
                        'type' => 'offer',
                        'offer_title' => $offer->title,
                        'offer_description' => $offer->description,
                        'end_date' => $endDate->format('Y-m-d'),
                        'notification' => $notificationMessage,
                        'is_past' => $isPast,
                    ];
                });
    
            $notifications = $bookings->merge($offers);
    
            return view('user.notifications.index', [
                'notifications' => $notifications,
            ]);
        } else {
            return redirect()->route('login')->with('error', 'You need to log in to view your notifications');
        }
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
