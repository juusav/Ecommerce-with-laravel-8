<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    //Relación uno a muchos
    public function city(){
        return $this->hasMany(City::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }

}
