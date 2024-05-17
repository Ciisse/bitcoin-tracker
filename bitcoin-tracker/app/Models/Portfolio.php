<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{

    protected $table = 'portfolios';

    // Specify which fields are assignable
    protected $fillable = ['user_id', 'balance', 'last_update'];
}

$newBalance = 5;
$userPortfolio = Portfolio::where('user_id', $userId)->first();
$userPortfolio->balance = $newBalance; // Set newBalance to the desired value
$userPortfolio->save();
return view('portfolio.show', ['balance' => $userPortfolio->balance]);
=======
    use HasFactory;

    protected $fillable = [
        'user_id', 'balance', 'last_update'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->hasMany(PortfolioHistory::class);
    }
}

