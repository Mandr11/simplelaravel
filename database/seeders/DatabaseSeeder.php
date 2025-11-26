<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gunakan firstOrCreate untuk menghindari duplikasi
        User::factory()->firstOrCreate(
            [
                'email' => 'test@example.com'
            ],
            [
                'name' => 'Test User',
            ]
        );

        // seed demo items for the frontend
        $this->call([ItemSeeder::class]);
    }
}