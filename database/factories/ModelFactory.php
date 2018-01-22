<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Entities\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(App\Entities\Product::class, function (Faker\Generator $faker){

   $repository = app(\App\Repositories\UserRepository::class);
   $authorId = $repository->all()->random()->id;

   return [
       'title' => $faker->sentence(3),
       'subtitle' => $faker->sentence(3),
       'price' => $faker->randomFloat(2,10,100),
       'user_id' => $authorId
   ];
});