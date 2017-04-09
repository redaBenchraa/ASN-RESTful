<?php
$factory->define(\App\Account::class, function (Faker\Generator $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'Email' => $faker->email,
        'About' => $faker->sentence(5),
        'showEmail' => $faker->boolean(),
        'Image' => $faker->image(),
        'xCoordinate' => 0.0,
        'yCoordinate' => 0.0
    ];
});
$factory->define(\App\Grp::class, function (Faker\Generator $faker) {
    return [
        'Name' => $faker->name,
        'Image' => null,
        'creationDate' => $faker->dateTime,
        'About' => $faker->word(50),
        'Account_id' => $faker->numberBetween(1,100)
    ];
});
$factory->define(\App\Message::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->word(100),
        'Account_id' => $faker->numberBetween(1,100),
        'Conversation_id' => $faker->numberBetween(1,30)
    ];
});
$factory->define(\App\Post::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->word(100),
        'Image' => $faker->image(null,10,10,null,true),
        'File' => null,
        'Type' => $faker->numberBetween(1,3),
        'postingDate' => $faker->dateTime,
        'Popularity' => $faker->randomNumber(3),
        'Account_id' => $faker->numberBetween(1,100),
        'Group_id' => $faker->numberBetween(1,20)
    ];
});
$factory->define(\App\Poll::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->word(100),
        'Vote' => $faker->randomNumber(3),
        'Account_id' => $faker->numberBetween(1,100),
        'Group_id' => $faker->numberBetween(1,20)
    ];
});
$factory->define(\App\Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->word(100),
        'File' => null,
        'Type' => $faker->numberBetween(1,3),
        'Popularity' => $faker->numberBetween(1,100),
        'Account_id' => $faker->numberBetween(1,100),
        'Post_id' => $faker->numberBetween(1,10),

    ];
});
$factory->define(\App\Notification::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->word(100),
        'dateAndTime' => $faker->dateTime,
        'Seen' => $faker->boolean,
        'Post_id' => $faker->numberBetween(1,10),
        'Account_id' => $faker->numberBetween(1,100)
    ];
});
$factory->define(\App\MessageNotification::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->word(100),
        'Seen' => $faker->boolean,
        'Message_id' => $faker->numberBetween(1,30),
        'Account_id' => $faker->numberBetween(1,100)
    ];
});
$factory->define(\App\Poll::class, function (Faker\Generator $faker) {
    return [
        'Content' => $faker->word(100),
        'Vote' => $faker->numberBetween(1,70),
        'Post_id' => $faker->numberBetween(1,10)
    ];
});
$factory->define(\App\Conversation::class, function (Faker\Generator $faker) {
    return [
    ];
});
