<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{
    public $product, $quantity;
    public $qty = 1;
    public $options = [
        'color_id' => null,
        'size_id' => null
    ];

    public function mount(){ //Método constructor se ejecutará una vez se haya cargado los productos
        $this->quantity = qty_available($this->product->id);
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }
    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem(){
        Cart::add(['id' => $this->product->id,
                    'name' => $this->product->name,
                    'qty' => $this->qty,
                    'price' => $this->product->price,
                    'weight' => 550,
                    'options' => $this->options
                ]);

        $this->quantity = qty_available($this->product->id); //La info se actualiza
        $this->reset('qty');
        $this->emitTo('dropdown-cart', 'render'); //  Para un componente el evento será emitto. Se envia al componente Dropdown
    }

    public function render(){
        return view('livewire.add-cart-item');
    }
}
