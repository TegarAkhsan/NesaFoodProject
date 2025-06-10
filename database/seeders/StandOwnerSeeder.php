<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StandOwner;
use Illuminate\Support\Facades\Hash;

class StandOwnerSeeder extends Seeder
{
    public function run(): void
    {
        StandOwner::create([
            'name' => 'Pemilik Stand 1',
            'email' => 'stand1@example.com',
            'password' => Hash::make('password'),
            'stand_name' => 'Stand Ayam Geprek'
        ]);
    }
}

