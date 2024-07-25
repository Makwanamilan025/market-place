<?php

namespace App\Repositories;


use App\Models\Stores;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StoresRepository
{
    public function store($input)
    {
        $stores = Stores::create($input);
        return $stores;

    }
    public function all($request)
    {
        $perPage = $request['per_page'] ?? 10;
        $query = Stores::latest()->paginate($perPage);
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
        
        return $query;
    }

    
}