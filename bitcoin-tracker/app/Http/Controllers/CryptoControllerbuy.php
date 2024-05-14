<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoControllerbuy extends Controller
{
    public function index()
    {
        return view('crypto');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'action' => 'required',
            'crypto' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Process the data, such as saving to database or performing an API call

        return back()->with('success', 'Transaction successful!');
    }
}
