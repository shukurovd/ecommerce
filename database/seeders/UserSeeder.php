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
            'first_name' => 'Setora',
            'last_name' => 'Qobilova',
            'email' => 'setora77@gmail.com',
            'phone' => '555527777',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('editor');

        $user = User::create([
            'first_name' => 'Sanjar',
            'last_name' => 'Eshqobilov',
            'email' => 'sanjar88@gmail.com',
            'phone' => '555528888',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('shop-manager');

        $user = User::create([
            'first_name' => 'Jamila',
            'last_name' => 'Toxirova',
            'email' => 'jamila99@gmail.com',
            'phone' => '555529999',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('helpdesk-support');

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
