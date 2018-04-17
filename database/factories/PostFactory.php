<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
       'title'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
       'image' =>$faker->imageUrl($width = 640, $height = 480),
       'body'=>$faker->text($maxNbChars = 500)  ,
       'slug'=>str_slug($faker->sentence($nbWords = 6, $variableNbWords = true)),
       'subtitle'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
       // 'user_id'=>1,


    ];
});
