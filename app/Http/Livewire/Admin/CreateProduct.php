<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProduct extends Component{

    public $categories, $subcategories = [];
    public $category_id = "", $subcategory_id = "";
    public $name, $slug, $description;

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get(); 

        $this->reset('subcategory_id');
    }

    public function updatedName($value){
        $this->slug = Str::slug($value);
    }

    public function mount(){
        $this->categories = Category::all();
    }

    public function render(){
        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
