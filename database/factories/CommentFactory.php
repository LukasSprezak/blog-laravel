<?php
declare(strict_types=1);
/** @var Factory $factory */

use App\Model\Comment;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 2),
        'article_id' => rand(1, 10),
        'comment' => $faker->paragraph(rand(10, 15))
    ];
});
