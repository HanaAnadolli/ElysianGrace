<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoomDataTable;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomDataTable $dataTable)
    {
        return $dataTable->render('admin.room.index');
        // $room = Room::get();
        // return view('admin.room.index', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'check_in_info' => 'nullable|string',
                'check_out_info' => 'nullable|string',
                'house_rules' => 'nullable|string',
                'children_extra_beds_info' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation
                'price' => 'required|numeric|min:0',
                'selected_in_date' => 'nullable|date',
                'selected_out_date' => 'nullable|date',
                'adults' => 'nullable|integer|min:0',
                'children' => 'nullable|integer|min:0',
                'number_of_rooms' => 'nullable|integer|min:1',
                'amenities' => 'nullable|array',
                'amenities.*' => 'string', // Ensure amenities are strings
                'status' => 'required|string|in:available,reserved,not_available',
            ]);
    
            // Handle the main image upload
            $imagePath = 'default_image.jpg'; // Default image path
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/room_images/'), $imageName);
                $imagePath = $imageName;
            }
    
            // Handle amenities field
            if ($request->has('amenities')) {
                $validatedData['amenities'] = json_encode($request->input('amenities'));
            }
    
            // Create a new room
            Room::create(array_merge($validatedData, ['image' => $imagePath]));
    
            // Redirect with a success message
            return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
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
        $room = Room::findOrFail($id);
        return view('admin.room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'check_in_info' => 'nullable|string',
            'check_out_info' => 'nullable|string',
            'house_rules' => 'nullable|string',
            'children_extra_beds_info' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'selected_in_date' => 'required|date',
            'selected_out_date' => 'required|date',
            'adults' => 'required|integer|min:0',
            'children' => 'required|integer|min:0',
            'number_of_rooms' => 'required|integer|min:1',
            'amenities' => 'nullable|array',
            'status' => 'required|string',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('room_images', 'public');
            $validated['image'] = basename($imagePath);
        }
    
        $room->update($validated);
    
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        toastr('Deleted Successfully', 'success');

        return redirect()->route('rooms.index');
    }
}
