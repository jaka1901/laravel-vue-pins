<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Interviewee',
            'email' => 'test@glance.sg',
            'password' => bcrypt('password1234')
        ]);

        User::factory()
            ->hasPins(2)
            ->create();
    }
}
