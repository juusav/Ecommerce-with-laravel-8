<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
class CreateCategory extends Component{

    use WithFileUploads;

    // Propiedades
    public $brands, $categories, $rand; //Rand para limpiar el campo imagen luego de ser creada la categoria

    public $createForm = [
        'name' => null,
        'slug' => null,
        'image' => null,
        'brands' => [],
    ];

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:categories,slug', //Debe ser unico en la tabla categories campo slug
        'createForm.image' => 'required|image|max:1024',
        'createForm.brands' => 'required'
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.image' => 'imagen',
        'createForm.brands' => 'marcas'
    ];

    public function mount(){
        $this->getBrands();
        $this->getCategories();
        $this->rand = rand();
    }

    public function updatedCreateFormName($value){
        $this->createForm['slug'] = Str::slug($value);
    }

    public function getBrands(){
        $this->brands = Brand::all();
    }

    public function getCategories(){
        $this->categories = Category::all();
    }

    public function save(){
        $this->validate();

        $image = $this->createForm['image']->store('categories');

        // Relacionar las categorias con las marcas
        $category = Category::create([
            'name' => $this->createForm['name'],
            'slug' => $this->createForm['slug'],
            'image' => $image
        ]);
        $category->brands()->attach($this->createForm['brands']);

        $this->rand = rand(); //El número aleatorio creado en mount cambiará y cuando renderice la página este cambiará y se limpiará el input
        $this->reset('createForm');
        $this->getCategories();
        $this->emit('saved');
    }

    public function render(){
        return view('livewire.admin.create-category');
    }
}
