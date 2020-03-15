<?php
declare(strict_types=1);
/** @var Factory $factory */

use App\Model\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(1),
    ];
});
