<?php
declare(strict_types=1);
/** @var Factory $factory */

use App\Model\Article;
use App\Model\Category;
use Faker\Generator as Faker;
use Illuminate\{Database\Eloquent\Factory, Support\Str};

$factory->define(Article::class, function (Faker $faker) {

    $title = $faker->sentence;
    $slug = Str::slug($title);

    return [
        'user_id' => rand(1,2),
        'category_id' => rand(1, 4),
        'title' => $title,
        'slug' => $slug,
        'content'   => $faker->paragraph(10),
        'enabled' => rand(0, 1),
        'imageName' => $faker->sentence(1),
    ];
});
