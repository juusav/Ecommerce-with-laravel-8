<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
class CreateCategory extends Component{

    use WithFileUploads;

    public $brands;

    public $createForm = [
        'name' => null,
        'slug' => null,
        'icon' => null,
        'image' => null,
        'brands' => null,
    ];

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required',
        'createForm.icon' => 'required',
        'createForm.image' => 'required|image|max:1024',
        'createForm.brands' => 'required'
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.icon' => 'icono',
        'createForm.image' => 'imagen',
        'createForm.brands' => 'marcas'
    ];

    public function mount(){
        $this->getBrands();
    }

    public function updatedCreateFormName($value){
        $this->createForm['slug'] = Str::slug($value);
    }

    public function getBrands(){
        $this->brands = Brand::all();
    }

    public function save(){
        $this->validate();
    }

    public function render(){
        return view('livewire.admin.create-category');
    }
}
