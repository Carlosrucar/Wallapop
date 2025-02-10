<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Electrónica',
            'Moda',
            'Hogar',
            'Deportes',
            'Móviles',
            'Informática',            <?php
            php artisan tinker
            >>> App\Models\Category::truncate();
            >>> exit
            'Juegos',
            'Libros'
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}