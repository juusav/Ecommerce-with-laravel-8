<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
class CreateCategory extends Component{

    use WithFileUploads;

    // Propiedades
    public $brands, $categories, $category, $rand; //Rand para limpiar el campo imagen luego de ser creada la categoria

    protected $listeners = ['delete'];

    public $createForm = [
        'name' => null,
        'slug' => null,
        'image' => null,
        'brands' => [],
    ];

    public $editForm = [
        'open' => false, 
        'name' => null,
        'slug' => null,
        'image' => null,
        'brands' => [],
    ];

    public $editImage;

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
        'createForm.brands' => 'marcas',
        'editForm.name' => 'nombre',
        'editForm.slug' => 'slug',
        'editImage' => 'imagen',
        'editForm.brands' => 'marcas'
    ];

    public function mount(){
        $this->getBrands();
        $this->getCategories();
        $this->rand = rand();
    }

    public function updatedCreateFormName($value){
        $this->createForm['slug'] = Str::slug($value);
    }

    public function updatedEditFormName($value){
        $this->editForm['slug'] = Str::slug($value);
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

    public function edit(Category $category){
        $this->reset(['editImage']);
        $this->category = $category;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $category->name;
        $this->editForm['slug'] = $category->slug;
        $this->editForm['image'] = Storage::url($category->image);
        $this->editForm['brands'] = $category->brands->pluck('id'); //Solo trae una marca 
    }

    public function update(){
        $rules = [
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:categories,slug,' . $this->category->id , 
            'editForm.brands' => 'required'
        ];

        if($this->editImage){
            $rules['editImage'] = 'required|image|max:1024';
        }

        $this->validate($rules);
    }

    public function delete(Category $category){
        $category->delete();
        $this->getCategories();
    }

    public function render(){
        return view('livewire.admin.create-category');
    }
}
