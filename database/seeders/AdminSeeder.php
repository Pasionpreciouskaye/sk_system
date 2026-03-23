<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'Barangaytanyag@gmail.com',
            ],
            [
            'first_name' => 'Barangay',
            'middle_name' => 'T.',
            'last_name' => 'Tanyag',
            'contact_number' => '09876543212',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'gender' => 'male',
            'date_of_birth' => '2005-03-16',
            'address' => 'Taguig City',
        ]);
    }
}
