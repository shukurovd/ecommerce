<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => [
                'uz' => 'Stol',
                'ru' => 'Стол'
            ],
        ]);
        Category::create([
            'name' => [
                'uz' => 'Divan',
                'ru' => 'Диван'
            ],
        ]);
        $category = Category::create([
            'name' => [
                'uz' => 'Kreslo',
                'ru' => 'Кресло'
            ],
        ]);
        $category->childCategories()->create([
            'name' => [
                'uz' => 'Offis',
                'ru' => 'Offis ru'
            ],
        ]);
        $childCategory = $category->childCategories()->create([
            'name' => [
                'uz' => 'Gaming',
                'ru' => 'Gaming ru'
            ],
        ]);
        $childCategory->childCategories()->create([
            'name' => [
                'uz' => 'Rgb',
                'ru' => 'Rgb ru'
            ],
        ]);
        $childCategory->childCategories()->create([
            'name' => [
                'uz' => 'Woman',
                'ru' => 'Woman ru'
            ],
        ]);
        $childCategory->childCategories()->create([
            'name' => [
                'uz' => 'Black',
                'ru' => 'Black ru'
            ],
        ]);
        $category->childCategories()->create([
            'name' => [
                'uz' => 'Yumshoq',
                'ru' => 'Yumshoq ru'
            ],
        ]);
        Category::create([
            'name' => [
                'uz' => 'Yotoq',
                'ru' => 'Кроват'
            ],
        ]);
        Category::create([
            'name' => [
                'uz' => 'Stul',
                'ru' => 'Стул'
            ],
        ]);
    }
}
