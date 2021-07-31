<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class ShowCategory extends Component{

    public $category, $subcategories;

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:categories,slug', //Debe ser unico en la tabla categories campo slug
        'createForm.color' => 'required',
        'createForm.size' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
    ];

    public $createForm = [
        'name' => null,
        'slug' => null,
        'color' => false,
        'size' => false,
    ];

    public function mount(Category $category){
        $this->category = $category;
        $this->getSubcategories();
    }

    public function updatedCreateFormName($value){
        $this->createForm['slug'] = Str::slug($value);
    }

    public function getSubcategories(){
        $this->subcategories = Subcategory::where('category_id', $this->category->id)->get();
    }

    public function save(){
        $this->validate();
    }

    public function edit(Subcategory $subcategory){
         
    }

    public function render(){
        return view('livewire.admin.show-category')->layout('layouts.admin');
    }
}
