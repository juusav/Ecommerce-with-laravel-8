<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category, $subcategoria, $marca;

    public $view = 'list';

    protected $queryString = ['subcategoria', 'marca'];
    
    public function limpiar(){
        $this->reset(['subcategoria', 'marca', 'page']);
    }

    public function updatedSubcategoria(){
        $this->resetPage();
    }

    public function updatedMarca(){
        $this->resetPage();
    }

    public function render(){
        // He separado la consulta y la coleccion para poder realizar consultas dinamicas

        // CONSULTA
        $productsQuery = Product::query()->WhereHas('subcategory.category', function(Builder $query){
            $query->where('id', $this->category->id); //id que coincida con el id de la categoria
            //Ya que no hay una relación directa de productos a categoria usé el...
            //intermediario que es subcategoria para poder llegar a categoria

        });

        // Si tengo agregado algo almacenado en subcategoria agregará un filtro a la relación subcategory y mostrará los productos relacionados a dichas subcategorias
        if ($this->subcategoria) {
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query){
                $query->where('slug', $this->subcategoria);
            }); //Este filtro se aplicará solamente si hay algo en la propiedad subcategory
        }
        if ($this->marca) {
            $productsQuery = $productsQuery->whereHas('brand', function(Builder $query){
                $query->where('name', $this->marca);
            });
        }

        // COLECCIÓN
        $products = $productsQuery->paginate(20);


        return view('livewire.category-filter', compact('products'));
    }

    
}
