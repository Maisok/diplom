<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'code'];
    
    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}