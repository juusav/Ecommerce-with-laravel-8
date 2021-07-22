<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Subcategory;

class ProductObserver{
    
    public function updated(Product $product){
        $subcategory_id = $product->subcategory_id;
        $subcategory = Subcategory::find($subcategory_id);

        if($subcategory->size){
            if($product->colors->count()){
                $product->colors()->detach();
            }

        }elseif ($subcategory->color){

            if($product->sizes->count()){
                foreach ($product->sizes as $size){
                    $size->delete();
                }
            }
        }
        else{ //Si no hay 

            if($product->colors->count()){
                $product->colors()->detach();
            }
            
            if($product->sizes->count()){
                foreach ($product->sizes as $size){
                    $size->delete();
                }
            }            
        }
    }
}
