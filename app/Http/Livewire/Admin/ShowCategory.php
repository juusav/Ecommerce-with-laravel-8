<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class ShowCategory extends Component{

    public $category;

    public function mount(Category $category){
        $this->category = $category;
    }
    
    public function render(){
        return view('livewire.admin.show-category');
    }
}
