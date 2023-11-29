<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';
    protected $fillable = [
        'name',
        'year',
    ];
    public function rounds(){
        return $this->hasMany(Round::class, 'race_id', 'id');
    }
}
