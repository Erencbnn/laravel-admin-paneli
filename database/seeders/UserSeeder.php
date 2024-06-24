<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Eren',
            'email' => 'eren@coban.com',
            'password'=>bcrypt('12345678'),

        ]);

        User::factory(100)->create();
    }
}
