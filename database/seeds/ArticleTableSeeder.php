<?php
declare(strict_types=1);

use App\Model\Article;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    public function run(): void
    {

        foreach(range(1,10) as $i ) {
            $factory = factory(Article::class);
            $factory->create();
        }

       // factory(Article::class, 50)->create();
    }
}
