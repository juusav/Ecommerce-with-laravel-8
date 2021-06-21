<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class ColorSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $sizes = Size::all();

        foreach ($sizes as $size){
            $size->colors()
                ->attach([
                    1 => ['quantity'=> 10], //Aparte de relacionarlos agregará los datos a un campo llamado quantity lo llenará con el valor de 10
                    2 => ['quantity'=> 10], 
                    3 => ['quantity'=> 10],  
                    4 => ['quantity'=> 10]]);
        }
    }
}
