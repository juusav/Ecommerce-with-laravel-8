<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class CreateOrder extends Component
{
    public $address, $reference;    
    public $departments, $cities = [], $districts = [];
    public $department_id = "", $city_id = "", $district_id = "";

    public function mount(){
        $this->departments = Department::all();
    }

    public function render(){
        return view('livewire.create-order');
    }
}
