<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Stand;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $stands = Stand::all();

        foreach ($stands as $stand) {
            // 3 menu makanan
            for ($i = 1; $i <= 3; $i++) {
                Menu::create([
                    'stand_id' => $stand->id,
                    'name' => "Makanan $i - Stand $stand->id",
                    'price' => rand(10000, 15000),
                    'type' => 'makanan',
                    'description' => "Deskripsi Makanan $i di Stand $stand->id",
                    'image' => 'default-food.jpg'
                ]);
            }

            // 3 menu minuman
            for ($i = 1; $i <= 3; $i++) {
                Menu::create([
                    'stand_id' => $stand->id,
                    'name' => "Minuman $i - Stand $stand->id",
                    'price' => rand(5000, 10000),
                    'type' => 'minuman',
                    'description' => "Deskripsi Minuman $i di Stand $stand->id",
                    'image' => 'default-drink.jpg'
                ]);
            }
        }
    }
}
