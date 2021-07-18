<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city_id'];

    //Relación uno a muchos
    public function order(){
        return $this->hasMany(Order::class);
    }
}
