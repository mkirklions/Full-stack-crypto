<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Txn::class, function (Faker $faker) {
    return [
            'user_id'=> $faker -> randomDigit,
            'friend_id'=> $faker -> randomDigit,
            'txn_number'=> $faker -> randomDigit,
            'myspy_credit'=>$faker-> randomDigit,
            'note'=>$faker->paragraph,
            'type'=>"TestTrans",
            'device'=> "MichaelsPC",
        //
    ];
});
