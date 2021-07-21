<?php

namespace App\Http\Livewire\Admin;

use App\Models\Size;
use Livewire\Component;

class SizeProduct extends Component{

    public $product, $name, $open = "false";
    public $name_edit;
    
    protected $rules=[
        'name' => 'required'
    ];

    public function save(){
        $this->validate();  

        $this->product->sizes()->create([
            'name' => $this->name
        ]);
        $this->product = $this->product->fresh();
    }

    public function edit(Size $size){
        $this->open = true;
        $this->name_edit = $size->name;
    }

    public function render(){
        $sizes = $this->product->sizes;
        return view('livewire.admin.size-product', compact('sizes'));
    }
}
