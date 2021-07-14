<?php

use App\Models\Product;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

function quantity ($product_id, $color_id = null, $size_id = null){ //Color_id y size_id son campos opcionales por eso el "= null"
    $product = Product::find($product_id);

    if($size_id){ 
        $size = Size::find($size_id); //Busca la talla
        $quantity = $size->colors->find($color_id)->pivot->quantity; //Busca color

    }elseif($color_id){
        $quantity = $product->colors->find($color_id)->pivot->quantity;

    }else{
        $quantity = $product->quantity;
    }

    return $quantity;
}

//Determina la cantidad de productos que hay en el carrito
function qty_added($product_id, $color_id = null, $size_id = null){
    $cart = Cart::content();

    $item = $cart->where('id', $product_id)
                ->where('options.color_id', $color_id)
                ->where('options.size_id', $size_id)
                ->first(); //Con first indico que no se trata de una coleccion sino de un objeto

    if($item){
        return $item->qty;
    }else{
        return 0;
    }
}

function qty_available($product_id, $color_id = null, $size_id = null){
    
    return quantity($product_id, $color_id, $size_id) - qty_added($product_id, $color_id, $size_id);
}