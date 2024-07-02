<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '555523085',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'first_name' => 'Dilmurod',
            'last_name' => 'Shukurov',
            'email' => 'shukurovd@gmail.com',
            'phone' => '995523085',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('customer');

        $users = User::factory()->count(10)->create();
        foreach($users as $user){
            $user->assignRole('customer');
        }
    }
}
