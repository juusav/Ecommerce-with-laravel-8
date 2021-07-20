<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProduct extends Component{

    public $categories, $subcategories = [], $brands = [];
    public $category_id = "", $subcategory_id = "", $brand_id = "";
    public $name, $slug, $description, $price, $quantity;

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'brand_id' => 'required',
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'slug' => 'required|unique:products',
    ];

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get(); 
        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value){
            $query->where('category_id', $value);
        })->get();
        $this->reset(['subcategory_id', 'brand_id']);
    }

    public function updatedName($value){
        $this->slug = Str::slug($value);
    }

    // Propiedad computada
    public function getSubcategoryProperty(){
        return Subcategory::find($this->subcategory_id);
    }

    public function mount(){
        $this->categories = Category::all();
    }

    public function save(){
        
        $rules = $this->rules;

        if($this->subcategory_id){
            if(!$this->subcategory->color && !$this->subcategory->size){
                $rules['quantity'] = 'required';
            }
        }
        $this->validate($rules);

        $product = new Product();

        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->price = $this->price;
        $product->description = $this->description;
        $product->subcategory_id = $this->subcategory_id;
        $product->brand_id = $this->brand_id;

        if($this->subcategory_id){
            if(!$this->subcategory->color && !$this->subcategory->size){
                $product->quantity = $this->quantity;
            }
        }
        $product->save();
        return redirect()->route('admin.products.edit', $product);
    }

    public function render(){
        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
