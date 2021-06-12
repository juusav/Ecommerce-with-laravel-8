<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => 'subcategories/' . $this->faker->image('public/storage/subcategories', 640, 480, null, false) //False para no almacenar la ruta en la BD. on false solo se almacena solo la carpeta y el nombre de la imagen
        ];
    }
}
