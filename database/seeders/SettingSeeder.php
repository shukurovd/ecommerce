<?php

namespace Database\Seeders;

use App\Enums\SettingType;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::create([
            'name' => [
                'uz' =>'Til',
                'ru' =>'Lenguage ru'
            ],
            'type' => SettingType::SELECT->value,
        ]);
        $setting->values()->create([
            'name' => [
                'uz' =>'Uzbekcha',
                'ru' =>'Uzbekcha ru'
            ],
        ]);
        $setting->values()->create([
            'name' => [
                'uz' =>'Ruscha',
                'ru' =>'Ruscha ru'
            ],
        ]);


        $setting = Setting::create([
            'name' => [
                'uz' =>'Pul birligi',
                'ru' =>'Pul birligi ru'
            ],
            'type' => SettingType::SELECT->value,
        ]);
        $setting->values()->create([
            'name' => [
                'uz' =>'sum',
                'ru' =>'sum ru'
            ],
        ]);
        $setting->values()->create([
            'name' => [
                'uz' =>'dollor',
                'ru' =>'dollor ru'
            ],
        ]);


        $setting = Setting::create([
            'name' => [
                'uz' =>'Dark Mode',
                'ru' =>'Dark Mode ru'
            ],
            'type' => SettingType::SWITCH->value,
        ]);

        $setting = Setting::create([
            'name' => [
                'uz' =>'Xabarnomalar',
                'ru' =>'Xabarnomalar ru'
            ],
            'type' => SettingType::SWITCH->value,
        ]);
    }
}
