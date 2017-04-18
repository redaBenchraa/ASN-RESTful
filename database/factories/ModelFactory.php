<?php


use App\Services\v1\seedNumber;

$factory->define(\App\Account::class, function (Faker\Generator $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'Email' => $faker->email,
        'About' => $faker->sentence(5),
        'showEmail' => $faker->boolean(),
        'Image' => null,
        'xCoordinate' => 0.0,
        'yCoordinate' => 0.0
    ];
});
$factory->define(\App\Grp::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'Name' => $faker->name,
        'Image' => null,
        'creationDate' => $faker->dateTime,
        'About' => $faker->word(50),
        'Grp_id' => random_int(\DB::table('grps')->min('id'), \DB::table('grps')->max('id')),
        'Account_id' =>random_int(\DB::table('accounts')->min('id'), \DB::table('accounts')->max('id')),
    ];
});

$factory->define(\App\Grp::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'Name' => $faker->name,
        'Image' => null,
        'creationDate' => $faker->dateTime,
        'About' => $faker->word(50),
        'Grp_id' => random_int(\DB::table('grps')->min('id'), \DB::table('grps')->max('id')),
        'Account_id' =>random_int(\DB::table('accounts')->min('id'), \DB::table('accounts')->max('id')),
    ];
});
$factory->define(\App\Message::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();

    return [
        'content' => $faker->word(100),
        'Account_id' => $faker->numberBetween(1,$seeder->accountNumber),
        'Conversation_id' => random_int(\DB::table('conversations')->min('id'), \DB::table('conversations')->max('id')),
    ];
});
$factory->define(\App\Post::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'Image' => null,
        'File' => null,
        'Type' => $faker->numberBetween(1,$seeder->postType),
        'postingDate' => $faker->dateTime,
        'Popularity' => $faker->randomNumber(3),
        'Account_id' => random_int(\DB::table('accounts')->min('id'), \DB::table('accounts')->max('id')),
        'Grp_id' =>random_int(\DB::table('grps')->min('id'), \DB::table('grps')->max('id')),
    ];
});
$factory->define(\App\Poll::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'Vote' => $faker->randomNumber(3),
        'Post_id' => random_int(\DB::table('posts')->min('id'), \DB::table('posts')->max('id')),
    ];
});
$factory->define(\App\Comment::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'File' => null,
        'Type' => $faker->numberBetween(1,3),
        'Popularity' => $faker->numberBetween(1,100),
        'Account_id' => random_int(\DB::table('accounts')->min('id'), \DB::table('accounts')->max('id')),
        'Post_id' =>random_int(\DB::table('posts')->min('id'), \DB::table('posts')->max('id')),

    ];
});
$factory->define(\App\Notification::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'dateAndTime' => $faker->dateTime,
        'Seen' => $faker->boolean,
        'Post_id' => random_int(\DB::table('posts')->min('id'), \DB::table('posts')->max('id')),
        'Account_id' => random_int(\DB::table('accounts')->min('id'), \DB::table('accounts')->max('id')),
    ];
});
$factory->define(\App\MessageNotification::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'Seen' => $faker->boolean,
        'Message_id' => random_int(\DB::table('messages')->min('id'), \DB::table('messages')->max('id')),
        'Account_id' => random_int(\DB::table('accounts')->min('id'), \DB::table('accounts')->max('id')),
    ];
});
$factory->define(\App\Conversation::class, function (Faker\Generator $faker) {
    return [
    ];
});
