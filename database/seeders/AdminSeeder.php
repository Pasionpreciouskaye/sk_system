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
                'email' => 'preciouskayepasion@gmail.com',
            ],
            [
            'first_name' => 'Admin',
            'middle_name' => 'Lower',
            'last_name' => 'Bicutan',
            'contact_number' => '09876543212',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'gender' => 'Female',
            'date_of_birth' => '2005-03-16',
            'address' => 'Taguig City',
        ]);
    }
}
