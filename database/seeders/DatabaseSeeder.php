<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Nur Khabib Fahrur Rozi',
            'email' => 'bheejr9@gmail.com',
            'password' => bcrypt('admin123'),
            'remember_token' => Str::random(20),
        ]);
    }
}
