<?php

use App\Department;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->unique()->sentence(3);
    return [
        'title' => $title,
        'url' => str_slug($title),
//        'excerpt' => $faker->text(50),
//        'body' => $faker->text(100),
//        'iframe' => $faker->text(50),
//        'published_at' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-30 days', '+3 days')->getTimestamp()),
        'user_id' => function () {
            return factory(\App\User::class)->create(['role'=>'admin']);
        },
//        'category_id' => function () {
//            return factory(\App\Category::class)->create();
//        }
    ];
});

//$departments = Department::all();;
//$factory->afterCreating(\App\Post::class,function($post, $faker) use($departments){
//    $post->departments()->attach($departments->random(rand(0, 17)));
//});
