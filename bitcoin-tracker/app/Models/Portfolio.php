<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
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

