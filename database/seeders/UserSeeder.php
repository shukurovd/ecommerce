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
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '555523085',
            'password' => Hash::make('password'),
        ]);

        $admin->roles()->attach(1);

        $admin = User::create([
            'first_name' => 'Dilmurod',
            'last_name' => 'Shukurov',
            'email' => 'shukurovd@gmail.com',
            'phone' => '995523085',
            'password' => Hash::make('password'),
        ]);

        $admin->roles()->attach(2);

        User::factory()->count(10)->hasAttached([Role::find(2)])->create();
    }
}
