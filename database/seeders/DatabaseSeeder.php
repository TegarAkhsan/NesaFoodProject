<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StandSeeder::class,
            MenuSeeder::class,
            StandOwnerSeeder::class,
        ]);

        // Tambah Pembeli Demo agar otomatis ada saat seeder dijalankan
        \App\Models\User::firstOrCreate(
            ['email' => 'pembeli@example.com'],
            [
                'name' => 'Pembeli Demo',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );
    }
}
