<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stand;

class StandSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            Stand::create([
                'name' => "Stand $i",
                'location' => "Blok $i",
                'description' => "Deskripsi Stand $i"
            ]);
        }
    }
}

