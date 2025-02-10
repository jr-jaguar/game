<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    protected $fillable = [
        'player_id',
        'random_number',
        'is_win',
        'win_amount'
    ];

    protected $casts = [
        'is_win' => 'boolean',
        'win_amount' => 'decimal:2',
        'random_number' => 'integer'
    ];
}
