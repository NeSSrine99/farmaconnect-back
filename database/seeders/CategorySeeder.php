<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Pain Relief',
            'Cold & Flu',
            'Vitamins & Supplements',
            'Skin Care',
            'Baby Care',
            'Allergy & Sinus'
        ];

        foreach($categories as $cat){
            Category::create(['name' => $cat]);
        }
    }
}