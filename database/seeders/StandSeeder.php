<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stand;
use Faker\Factory as Faker;

class StandSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $prefixes = ['Warung', 'Kedai', 'Depot', 'Dapur', 'Gerobak', 'Booth', 'Rasa', 'Lesehan', 'Pojok', 'Cafe'];
        $adjectives = ['Lezat', 'Mantap', 'Gacor', 'Nusantara', 'Laris', 'Spesial', 'Hits', 'Legend', 'Kekinian', 'Favorit'];
        $subjects = ['Rasa', 'Selera', 'Cita Rasa', 'Minang', 'Betawi', 'Sunda', 'Madura', 'Corner', 'Express', 'Barokah'];
        $locations = [
            'Foodcourt Blok A', 'Foodcourt Blok B', 'Foodcourt Tengah',
            'Foodcourt Pintu Masuk', 'Foodcourt Timur', 'Foodcourt Barat'
        ];

        foreach (range(1, 20) as $i) {
            Stand::create([
                'name' => $faker->randomElement($prefixes) . ' ' .
                          $faker->randomElement($adjectives) . ' ' .
                          $faker->randomElement($subjects),
                'location' => $faker->randomElement($locations),
                'description' => 'Menyediakan berbagai pilihan kuliner favorit dengan cita rasa khas ' . $faker->city() . ' dan pelayanan ramah.'
            ]);
        }
    }
}
