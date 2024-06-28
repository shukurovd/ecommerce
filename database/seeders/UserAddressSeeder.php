<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    
    public function run(): void
    {
        User::find(2)->addresses()->create([
            "latitude" => "41.310014",
            "longitude" => "69.280742",
            "region" => "Toshkent",
            "district" => "Mirobod tumani",
            "street" => "Minggurik Maxalla",
            "home" => "123"
        ]);
        User::find(2)->addresses()->create([
            "latitude" => "41.310014",
            "longitude" => "69.280742",
            "region" => "Toshkent",
            "district" => "Mirzu U tumani",
            "street" => "Minggurik Maxalla",
            "home" => "234"
        ]);
    }
}
