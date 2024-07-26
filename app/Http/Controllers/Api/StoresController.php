<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResources;
use App\Models\Stores;
use App\Repositories\StoresRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoresRequest;

class StoresController extends Controller
{

    public $storesRepo;

    public function __construct(StoresRepository $StoresRepository) {
        $this->storesRepo = $StoresRepository;
    }
 

    public function index(Request $request)
    {
        $perPage = ($request->filled('per_page')) ? $request->per_page : 10;
        $search = $request->search;
       

        $query = Stores::when($request->filled('search'), function (Builder $query) use ($search) {
            $query->where(function (Builder $query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('zip', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('currency', 'like', "%{$search}%")
                    ->orWhere('multi_location_enabled', 'like', "%{$search}%");
            });

        });

        $data = $query->latest()->paginate($perPage);

        $stores = StoreResources::collection($data);

        return $this->sendResponse($stores->appends(null), 'Stores listed successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresRequest $request)
    {
        $input = $request->all();
        $this->storesRepo->store($input);
    
        return $this->sendSuccess('Stores created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoresRequest $request, $id)
    {
        $input = $request->all();
        $store = Stores::findOrFail($id);
        $this->storesRepo->update($input, $store);

        return $this->sendSuccess('Stores update successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stores $store)
    {   

        $store->delete();

        return $this->sendSuccess('stores deleted successfully.');
    }
}
