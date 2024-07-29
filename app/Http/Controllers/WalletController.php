<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:stores,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        Wallet::create($request->all());
        return $this->sendSuccess('recorde store successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:stores,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        $wallet->update($request->all());
        return redirect()->route('wallets.index')->with('success', 'Wallet updated successfully.');
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
