<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\DataTables\OfferDataTable;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::all(); // Fetch all offers
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        return view('admin.offers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'month' => 'required|integer|min:1|max:12',
        ]);
    
        // Log the validated data to verify it's correct
        \Log::info('Validated data:', $validated);
    
        // Map 'percentage' to 'discount_percentage'
        $validated['discount_percentage'] = $validated['percentage'];
        unset($validated['percentage']);
    
        // Log the data before creating
        \Log::info('Data to be inserted:', $validated);
    
        Offer::create($validated);
    
        return redirect()->route('offers.index')->with('success', 'Offer created successfully!');
    }
    
    public function edit(Offer $offer)
    {
        return view('admin.offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $offer->update($validated);

        return redirect()->route('offers.index')->with('success', 'Offer updated successfully!');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully!');
    }
}
