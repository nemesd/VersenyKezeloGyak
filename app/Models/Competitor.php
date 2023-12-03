<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $table = 'competitors';
    protected $fillable = [
        'user_id',
        'round_id',
    ];
    public function round(){
        return $this->belongsTo(Round::class, 'id', 'round_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
