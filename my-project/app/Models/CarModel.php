<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = ['brand_id', 'name'];
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    public function generations()
    {
        return $this->hasMany(Generation::class);
    }
}