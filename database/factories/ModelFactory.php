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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Game::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->text(200),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\GameBuild::class, function (Faker\Generator $faker) {
    return [
        'game_id' => function () {
            return factory(App\Game::class)->create()->id;
        },
        'name' => $faker->numerify('v#.##'),
        'description' => $faker->text(200),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\MetricCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text(200),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\MetricName::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->slug,
        'metric_category_id' => function () {
            return factory(App\MetricCategory::class)->create()->id;
        },
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Device::class, function (Faker\Generator $faker) {
    return [
        'uid' => $faker->unique()->sha1,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Platform::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement([
            $faker->numerify('Windows 10 Build #####.##'),
            $faker->numerify('macOS 10.1#'),
            $faker->numerify('GNU/Linux 4.#.#'),
            $faker->numerify('iOS 10.#'),
            $faker->randomElement([
                $faker->numerify('Android Nougat 7.#'),
                $faker->numerify('Android Marshmallow 6.#'),
                $faker->numerify('Android Lollipop 5.#'),
                $faker->numerify('Android KitKat 4.4.#'),
            ]),
        ]),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Session::class, function (Faker\Generator $faker) {
    return [
        'device_id' => function () {
            return factory(App\Device::class)->create()->id;
        },
        'platform_id' => function () {
            return factory(App\Platform::class)->create()->id;
        },
        'game_build_id' => function () {
            return factory(App\GameBuild::class)->create()->id;
        },
        'ip_address' => $faker->ipv4,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Session::class, function (Faker\Generator $faker) {
    return [
        'device_id' => function () {
            return factory(App\Device::class)->create()->id;
        },
        'platform_id' => function () {
            return factory(App\Platform::class)->create()->id;
        },
        'game_build_id' => function () {
            return factory(App\GameBuild::class)->create()->id;
        },
        'ip_address' => $faker->ipv4,
    ];
});

$factory->define(App\Metric::class, function (Faker\Generator $faker) {
    return [
        'session_id' => function () {
            return factory(App\Session::class)->create()->id;
        },
        'metric_name_id' => function () {
            return factory(App\MetricName::class)->create()->id;
        },
        'value' => $faker->randomNumber(3),
        'entries' => $faker->randomDigit(),
    ];
});



