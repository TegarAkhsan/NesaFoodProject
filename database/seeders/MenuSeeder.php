<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Stand;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $stands = Stand::all();

        foreach ($stands as $stand) {
            for ($i = 1; $i <= 10; $i++) {
                Menu::create([
                    'stand_id' => $stand->id,
                    'name' => "Makanan $i - Stand $stand->id",
                    'price' => rand(10000, 50000),
                    'type' => 'makanan',
                    'description' => "Deskripsi Makanan $i di Stand $stand->id",
                    'image' => 'default-food.jpg'
                ]);
            }

            for ($i = 1; $i <= 15; $i++) {
                Menu::create([
                    'stand_id' => $stand->id,
                    'name' => "Minuman $i - Stand $stand->id",
                    'price' => rand(5000, 25000),
                    'type' => 'minuman',
                    'description' => "Deskripsi Minuman $i di Stand $stand->id",
                    'image' => 'default-drink.jpg'
                ]);
            }
        }
    }
}
