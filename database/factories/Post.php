<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->sentence(6, true),
        'content' => $faker->text(500),
        'user_id' => 1
    ];
});
