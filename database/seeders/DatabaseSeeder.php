<?php

namespace Database\Seeders;

use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany([[
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'link_id' => strtolower(str_replace(' ', '-', 'Admin')) . '-' . Carbon::now()->format('dmY'),

            'role' => 'admin',
        ], [
            'name' => 'Client',
            'email' => 'client@gmail.com',
            'password' => Hash::make('123'),
            'link_id' => strtolower(str_replace(' ', '-', 'Client anda neh')) . '-' . Carbon::now()->format('dmY'),
            'role' => 'client',
        ]]);
    }
}
