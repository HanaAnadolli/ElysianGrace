<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ServiceDataTable;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'working_hours' => 'nullable|string', // Keep as plain text
                'rules' => 'nullable|string', // Keep as plain text
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            ]);

            // Handle the image upload
            $imagePath = 'default_image.jpg'; // Default image path

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/services_images/'), $imageName);
                $imagePath = $imageName;
            }

            // Create the service record
            $validatedData['image'] = $imagePath;
            Service::create($validatedData);

            // Redirect with success message
            return redirect()->route('services.index')->with('success', 'Service created successfully.');
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
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'working_hours' => 'nullable|string',
                'rules' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation
            ]);
    
            // Handle the image upload
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($service->image) {
                    Storage::delete('public/uploads/services_images/' . $service->image);
                }
    
                $image = $request->file('image');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/uploads/services_images/', $imageName);
                $validatedData['image'] = $imageName;
            }
    
            // Update the service
            $service->update($validatedData);
    
            // Redirect with a success message
            return redirect()->route('services.index')->with('success', 'Service updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        toastr('Deleted Successfully', 'success');

        return redirect()->route('services.index');
    }
}
