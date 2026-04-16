<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Paracetamol 500mg',
                'category_id' => 1,
                'brand' => 'PharmaBrand',
                'image' => 'products/paracetamol.jpg',
                'images' => json_encode(['products/paracetamol.jpg','products/paracetamol2.jpg']),
                'price' => 2.50,
                'discount' => 0,
                'stock' => 100,
                'availability' => 'in stock',
                'isNew' => true,
                'requiresPrescription' => false,
                'rating' => 4.5,
                'reviews' => 10,
                'reviewsList' => json_encode([
                    ['user'=>'Client1','review'=>'Very effective'],
                    ['user'=>'Client2','review'=>'Good value']
                ]),
                'description' => 'Pain relief for headaches and fever'
            ],
            [
                'name' => 'Ibuprofen 200mg',
                'category_id' => 1,
                'brand' => 'PharmaBrand',
                'image' => 'products/ibuprofen.jpg',
                'images' => json_encode(['products/ibuprofen.jpg']),
                'price' => 3.00,
                'discount' => 0,
                'stock' => 80,
                'availability' => 'in stock',
                'isNew' => false,
                'requiresPrescription' => false,
                'rating' => 4.2,
                'reviews' => 5,
                'reviewsList' => json_encode([]),
                'description' => 'Reduces pain, fever and inflammation'
            ],
            [
                'name' => 'Vitamin C 500mg',
                'category_id' => 3,
                'brand' => 'HealthPlus',
                'image' => 'products/vitamin_c.jpg',
                'images' => json_encode(['products/vitamin_c.jpg']),
                'price' => 5.00,
                'discount' => 0,
                'stock' => 200,
                'availability' => 'in stock',
                'isNew' => true,
                'requiresPrescription' => false,
                'rating' => 4.8,
                'reviews' => 15,
                'reviewsList' => json_encode([]),
            ],
            [
                'name' => 'Antibiotic Cream',
                'category_id' => 4,
                'brand' => 'MedSkin',
                'image' => 'products/antibiotic_cream.jpg',
                'images' => json_encode(['products/antibiotic_cream.jpg']),
                'price' => 6.50,
                'discount' => 0,
                'stock' => 50,
                'availability' => 'in stock',
                'isNew' => false,
                'requiresPrescription' => true,
                'rating' => 4.0,
                'reviews' => 8,
                'reviewsList' => json_encode([]),
            ],
            [
                'name' => 'Baby Lotion',
                'category_id' => 5,
                'brand' => 'BabyCare',
                'image' => 'products/baby_lotion.jpg',
                'images' => json_encode(['products/baby_lotion.jpg']),
                'price' => 4.00,
                'discount' => 0,
                'stock' => 60,
                'availability' => 'in stock',
                'isNew' => true,
                'requiresPrescription' => false,
                'rating' => 4.3,
                'reviews' => 6,
                'reviewsList' => json_encode([]),
            ],
            [
                'name' => 'Allergy Relief Tablets',
                'category_id' => 6,
                'brand' => 'AllerFree',
                'image' => 'products/allergy_relief.jpg',
                'images' => json_encode(['products/allergy_relief.jpg']),
                'price' => 7.00,
                'discount' => 0,
                'stock' => 40,
                'availability' => 'in stock',
                'isNew' => false,
                'requiresPrescription' => false,
                'rating' => 4.1,
                'reviews' => 4,
                'reviewsList' => json_encode([]),
            ]
        ];

        foreach($products as $p){
            Product::create($p);
        }
    }
}