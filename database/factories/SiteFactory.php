<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Site;
use Faker\Generator as Faker;

$factory->define(Site::class, function (Faker $faker) {
    return [
        'title' => $faker->words(3, true),
        'domain' => $faker->lexify('??????') . '.' . env('APP_DOMAIN'),
        'welcome_message' => 'Silahkan Anda melakukan pendaftaran dengan menggunakan sosial media Anda.',
        'privacy_policy' => 'Anda setuju bahwa Anda melakukan hal ini tanpa paksaan.',
    ];
});
