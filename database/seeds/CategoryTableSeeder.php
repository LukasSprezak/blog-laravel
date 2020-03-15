<?php
declare(strict_types=1);

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Aaa',
            'Bbb',
            'Ccc',
            'Ddd',
        ];

        foreach ($categories as $category) {
            factory(Category::class)->create([
                'name' => $category,
            ]);
        }
    }
}
