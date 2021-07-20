<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class EditProduct extends Component{

    public $product;

    public function mount(Product $product){
        $this->product = $product;
    }

    public function render(){
        return view('livewire.admin.edit-product')->layout('layouts.admin');
    }
}
