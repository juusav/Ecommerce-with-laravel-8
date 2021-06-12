<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder{
    public function run()
    {
        $categories = [
            [
                'name' => 'Moviles',
                'slug' => Str::slug('Moviles'),
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
            ],
            [
                'name' => 'Consolas y videojuegos',
                'slug' => Str::slug('Consolas y videojuegos'),
            ],
            [
                'name' => 'Tecnología',
                'slug' => Str::slug('Tecnología'),
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
            ],
        ];

        foreach($categories as $category){
            $category = Category::factory(1)->create($category)->first();
            $brands = Brand::factory(4)->create();

            foreach ($brands as $brand){
                $brand->categories()->attach($category->id);
            }
        }
    }
}
