<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function show()
    {
        $portfolio = Auth::user()->portfolio;
        return response()->json($portfolio);
    }

    public function history()
    {
        $history = Auth::user()->portfolio->history;
        return response()->json($history);
    }

    public function update(Request $request)
    {
        $request->validate([
            'balance' => 'required|numeric'
        ]);

        $portfolio = Auth::user()->portfolio;
        $portfolio->balance = $request->balance;
        $portfolio->save();

        $portfolioHistory = new PortfolioHistory([
            'portfolio_id' => $portfolio->id,
            'balance' => $portfolio->balance,
            'record_date' => now()
        ]);
        $portfolioHistory->save();

        return response()->json($portfolio);
    }
}
