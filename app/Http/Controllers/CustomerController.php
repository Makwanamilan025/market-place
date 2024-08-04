<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name'=> 'required',
                'email' => 'required',
                'password'=> 'required',
                'phone'=> 'required',
                'address1'=> 'required',
                'address2'=> 'required',
                'city'=> 'required',
                'state'=> 'required',
                'country'=> 'required',
                'status'=> 'required',
                'type'=> 'required',
            ]
        );

        Customer::create($request);
        return $this->sendSuccess('recorde created successfully.');

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