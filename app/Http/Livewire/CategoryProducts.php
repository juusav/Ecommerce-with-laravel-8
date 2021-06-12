<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryProducts extends Component
{
    public $category;

    public $products = [];

    public function loadPost(){
        $this->products = $this->category->products()->where('status', 2)->take(13)->get();

        $this->emit('glider', $this->category->id); //Lo que está dentro del parametro es un nombre X. Ubicación de la otra parte en Welcome script
    }

    public function render(){
        return view('livewire.category-products');
    }
}
