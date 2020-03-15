<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         $this->call(
             [
                 CategoryTableSeeder::class,
                 CommentTableSeeder::class,
                 UserTableSeeder::class,
                 ArticleTableSeeder::class,
             ]
         );
    }
}
