<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Stand;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $foodNames = [
            'Nasi Goreng Spesial', 'Ayam Geprek', 'Mie Goreng Jawa',
            'Sate Ayam Madura', 'Bakso Kuah Pedas', 'Rendang Padang',
            'Soto Ayam Lamongan', 'Nasi Ayam Kremes', 'Tahu Tek Surabaya'
        ];

        $drinkNames = [
            'Es Teh Manis', 'Jus Alpukat', 'Es Jeruk Segar',
            'Kopi Susu Gula Aren', 'Milkshake Coklat', 'Lemon Tea Dingin',
            'Matcha Latte', 'Es Kelapa Muda', 'Thai Tea'
        ];

        $foodDescriptions = [
            'Dimasak dengan bumbu rahasia dan penuh cita rasa.',
            'Pedasnya nendang! Cocok buat pecinta makanan pedas.',
            'Klasik dan menggugah selera dengan topping ayam suwir.',
            'Bakar sempurna dengan bumbu kacang khas Madura.',
            'Bakso kenyal dalam kuah segar yang menggoda.',
            'Rasa autentik Minang yang melekat di lidah.',
            'Hangat dan segar, cocok untuk makan siang.',
            'Ayam goreng renyah dengan sambal spesial.',
            'Campuran tahu, lontong, dan bumbu kacang gurih.'
        ];

        $drinkDescriptions = [
            'Dinginkan harimu dengan kesegaran klasik ini.',
            'Kental, manis, dan menyehatkan.',
            'Perpaduan sempurna antara asam dan manis.',
            'Kopi kekinian yang bikin melek seharian.',
            'Lembut dan manis, cocok untuk semua umur.',
            'Segar dan cocok diminum kapan saja.',
            'Rasa Jepang yang creamy dan ringan.',
            'Langsung dari kelapa muda pilihan.',
            'Manis dan creamy, favorit anak muda.'
        ];

        $stands = Stand::all();

        foreach ($stands as $stand) {
            // 3 makanan acak unik
            $selectedFoods = collect($foodNames)->random(3);
            foreach ($selectedFoods as $i => $food) {
                Menu::create([
                    'stand_id' => $stand->id,
                    'name' => $food,
                    'price' => rand(10000, 15000),
                    'type' => 'makanan',
                    'description' => $foodDescriptions[$i],
                    'image' => 'default-food.jpg'
                ]);
            }

            // 3 minuman acak unik
            $selectedDrinks = collect($drinkNames)->random(3);
            foreach ($selectedDrinks as $i => $drink) {
                Menu::create([
                    'stand_id' => $stand->id,
                    'name' => $drink,
                    'price' => rand(5000, 10000),
                    'type' => 'minuman',
                    'description' => $drinkDescriptions[$i],
                    'image' => 'default-drink.jpg'
                ]);
            }
        }
    }
}
