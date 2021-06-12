<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'justice velasco',
            'email' => 'justicevgomez001@gmail.com',
            'password' => bcrypt('koko11')
        ]);
    }
}
