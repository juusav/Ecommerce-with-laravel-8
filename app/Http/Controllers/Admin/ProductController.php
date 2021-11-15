<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller{
    
    public function files(Product $product, Request $request){

        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        $url = Storage::put('products', $request->file('file')); //Primer parametro es carpeta. segundo parametro es el nombre por la que se está mandando el archivo

        $product->images()->create([ //Relacionar las imagenes con los productos por medio de la tabla images 
            'url' => $url
        ]);
    }
}
