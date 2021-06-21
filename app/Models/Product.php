<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $guarded = ['id', 'created_at', 'update_at'];

    //Relación una a muchos
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    //Relación una a muchos inversa
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    //Relación muchos a muchos
    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity'); //withPivot trae la info de quantity
    }
    
    //Relación uno a muchos polimorfica
    public function images(){
        return $this->morphMany(Image::class, "imageable"); //Primer parametro establezco donde quiero que suceda y el segundo es la funcion  
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
