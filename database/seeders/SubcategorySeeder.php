<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            // Moviles
            [
                'category_id' => 1,
                'name' => 'Moviles y smartphones',
                'slug' => Str::slug('Moviles y smartphones'),
                'color' => true
            ],
            
            [
                'category_id' => 1,
                'name' => 'Accesorios para moviles',
                'slug' => Str::slug('Accesorios para moviles'),
            ],

            [
                'category_id' => 1,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],

            //TV, audio y video
            [
                'category_id' => 2,
                'name' => 'Tv y audio',
                'slug' => Str::slug('Tv y audio'),
            ],

            [
                'category_id' => 2,
                'name' => 'Audio',
                'slug' => Str::slug('Audio'),
            ],

            [
                'category_id' => 2,
                'name' => 'Audio para coches',
                'slug' => Str::slug('Audio para coches'),
            ],

            //Consola y videojuegos
            [
                'category_id' => 3,
                'name' => 'Xbox',
                'slug' => Str::slug('Xbox'),
            ],
            [
                'category_id' => 3,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => 3,
                'name' => 'Videojuegos para pc',
                'slug' => Str::slug('Videojuegos para pc'),
            ],
            [
                'category_id' => 3,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],

            //Tecnologia
            [
                'category_id' => 4,
                'name' => 'Cargadores',
                'slug' => Str::slug('Cargadores'),
            ],
            [
                'category_id' => 4,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => 4,
                'name' => 'Teclados y ratones',
                'slug' => Str::slug('Teclados y ratones'),
            ],
            [
                'category_id' => 4,
                'name' => 'Adaptadores',
                'slug' => Str::slug('Adaptadores'),
            ],

            //Moda
            [
                'category_id' => 5,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Gafas',
                'slug' => Str::slug('Gafas'),
            ],
            [
                'category_id' => 5,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];

        foreach($subcategories as $subcategory){
            Subcategory::create($subcategory);
        }
    }
}
