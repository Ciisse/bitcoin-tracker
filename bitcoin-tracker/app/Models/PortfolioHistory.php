<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id', 'balance', 'record_date'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}

