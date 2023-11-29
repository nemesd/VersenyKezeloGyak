<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $table = 'rounds';
    protected $fillable = [
        'name',
        'race_id',
    ];
    public function race(){
        return $this->belongsTo(Race::class, 'id', 'race_id');
    }
}
