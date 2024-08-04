<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\WalletRequest;


class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets = Wallet::with('user', 'store')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WalletRequest $request)
    {
      
        Wallet::create($request->all());
        return $this->sendSuccess('recorde store successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(WalletRequest $request, Wallet $wallet)
    {
        $wallet->update($request->all());
        return $this->sendSuccess('recorde update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wallet->delete();
        return $this->sendSuccess('recorde delete successfully.');
    }
}
