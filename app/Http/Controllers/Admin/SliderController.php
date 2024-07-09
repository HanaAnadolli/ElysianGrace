<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'max:20000'], // Changed from 'banner' to 'image'
            'title' => ['required', 'max:200'],
            'description' => ['required'],
            'link' => ['url'],
            'status' => ['required']
        ]);

        $slider = new Slider();

        // Assuming your uploadImage method expects a key name of the file input
        $imagePath = $this->uploadImage($request, 'banner', 'uploads');

        $slider->banner = $imagePath;
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->link = $request->link;
        $slider->status = $request->status;
        $slider->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('slider.index');
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

    public function changeStatus(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        $slider->status = $request->status == 'true' ? 1 : 0;
        $slider->save();

        return response(['message' => 'Status has been updated!']);
    }
}
