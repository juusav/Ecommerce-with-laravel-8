<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;

class CreateCategory extends Component{

    public $brands;

    public function mount(){
        $this->getBrands();
    }

    public function getBrands(){
        $this->brands = Brand::all();
    }

    public function save(){
        
    }

    public function render(){
        return view('livewire.admin.create-category');
    }
}
