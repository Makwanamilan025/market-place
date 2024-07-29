<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActiveModuleRequest;
use App\Http\Resources\ActiveModuleResource;
use App\Models\ActiveModule;
use Illuminate\Http\Request;


class ActiveModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = ($request->filled('per_page')) ? $request->per_page : 10;
        $activemodules = ActiveModule::where('name', 'like', "%{$request->search}%")
            ->latest()->paginate($perPage);

        $activemodules = ActiveModuleResource::collection($activemodules);
        return $this->sendResponse($activemodules, 'Record listed successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActiveModuleRequest $request)
    {

        $input = $request->all();
        ActiveModule::create($input);
        return $this->sendSuccess('Record created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActiveModuleRequest $request, string $id)
    {
        $input = $request->all();
        $module = ActiveModule::findOrFail($id);
        $module->update($input);

        return $this->sendSuccess('Record update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActiveModule $activemodule )
    {
        $activemodule->delete();

        return $this->sendSuccess('Record deleted successfully.');
    }
}
