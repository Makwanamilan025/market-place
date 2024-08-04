<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->gat();
        dd($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'phone' => 'nullable|string|max:20',
            'location_tag' => 'nullable|string|max:255',
        ]);

        Warehouse::create($request);
        return $this->sendSuccess('recorde created successfully.');
    }    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'phone' => 'nullable|string|max:20',
            'location_tag' => 'nullable|string|max:255',
        ]);

        Warhouse::update($request);
        return $this->sendSuccess('recorde update successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse )
    {
        $warehouse->delete();
        return $this->sendSuccess('recorde delete successfully.');
    }
}