<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::updateOrCreate(
            ['email' => 'Barangaytanyag@gmail.com'],
            [
                'first_name'         => 'Barangay',
                'middle_name'        => 'T.',
                'last_name'          => 'Tanyag',
                'role'               => User::ROLE_SUPER_ADMIN,
                'contact_number'     => '09876543212',
                'email_verified_at'  => now(),
                'password'           => bcrypt('admin'),
                'gender'             => 'male',
                'date_of_birth'      => '2005-03-16',
                'address'            => 'Taguig City',
            ]
        );

        // Treasurer account
        User::updateOrCreate(
            ['email' => 'treasurer@barangaytanyag.com'],
            [
                'first_name'         => 'SK',
                'middle_name'        => null,
                'last_name'          => 'Treasurer',
                'role'               => User::ROLE_TREASURER,
                'contact_number'     => '09111111111',
                'email_verified_at'  => now(),
                'password'           => bcrypt('treasurer123'),
                'gender'             => 'female',
                'date_of_birth'      => '2000-01-01',
                'address'            => 'Taguig City',
            ]
        );

        // Secretary account
        User::updateOrCreate(
            ['email' => 'secretary@barangaytanyag.com'],
            [
                'first_name'         => 'SK',
                'middle_name'        => null,
                'last_name'          => 'Secretary',
                'role'               => User::ROLE_SECRETARY,
                'contact_number'     => '09222222222',
                'email_verified_at'  => now(),
                'password'           => bcrypt('secretary123'),
                'gender'             => 'female',
                'date_of_birth'      => '2001-05-10',
                'address'            => 'Taguig City',
            ]
        );
    }
}

