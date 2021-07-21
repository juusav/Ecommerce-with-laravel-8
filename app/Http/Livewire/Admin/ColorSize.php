<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;

class ColorSize extends Component{

    public $size, $colors, $color_id, $quantity;

    protected $rules = [
        'color_id' => 'required',
        'quantity' => 'required|numeric'
    ];

    public function mount(){
        $this->colors = Color::all();
    }

    public function save(){
        $this->validate();

        $this->size->colors()->attach([
            $this->color_id => [
                'quantity' => $this->quantity
            ]
        ]);

        $this->reset(['color_id', 'quantity']);     

        $this->emit('saved');

        $this->size = $this->size->fresh();
    }

    public function render(){
        $size_colors = $this->size->colors;
        return view('livewire.admin.color-size', compact('size_colors'));
    }
}
