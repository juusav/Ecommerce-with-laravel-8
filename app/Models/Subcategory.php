<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at']; 

    //En una subcategory pueden haber muchos products
    public function products(){
        return $this->hasMany(Product::class); //Relacion uno a muchos
    }
    
    //Al recoger solo un dato pongo el nombre de la funcion en singular
    public function category(){
        return $this->belongsTo(Category::class); //Relacion uno a muchos inversa.
    }

}
