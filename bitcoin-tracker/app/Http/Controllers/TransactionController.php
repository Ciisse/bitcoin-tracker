<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function buy(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'price_per_unit' => 'required|numeric'
        ]);

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'type' => 'buy',
            'amount' => $request->amount,
            'price_per_unit' => $request->price_per_unit,
            'total_cost' => $request->amount * $request->price_per_unit
        ]);

        // Update user's portfolio balance
        $user = Auth::user();
        $portfolio = $user->portfolio;
        $portfolio->balance += $request->amount;
        $portfolio->save();

        return response()->json($transaction, 201);
    }

    public function sell(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'price_per_unit' => 'required|numeric'
        ]);

        $user = Auth::user();
        $portfolio = $user->portfolio;

        if ($portfolio->balance < $request->amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'type' => 'sell',
            'amount' => $request->amount,
            'price_per_unit' => $request->price_per_unit,
            'total_cost' => $request->amount * $request->price_per_unit
        ]);

        // Update portfolio balance
        $portfolio->balance -= $request->amount;
        $portfolio->save();

        return response()->json($transaction, 201);
    }
}

