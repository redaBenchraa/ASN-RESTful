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
        'Grp_id' => $faker->numberBetween(1,$seeder->groupNumber),
        'Account_id' => $faker->numberBetween(1,$seeder->accountNumber),
    ];
});
$factory->define(\App\Message::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();

    return [
        'content' => $faker->word(100),
        'Account_id' => $faker->numberBetween(1,$seeder->accountNumber),
        'Conversation_id' => $faker->numberBetween(1,$seeder->conversationNumber)
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
        'Account_id' => $faker->numberBetween(1,$seeder->accountNumber),
        'Grp_id' => $faker->numberBetween(1,$seeder->groupNumber)
    ];
});
$factory->define(\App\Poll::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'Vote' => $faker->randomNumber(3),
        'Post_id' => $faker->numberBetween(1,$seeder->postNumber),
    ];
});
$factory->define(\App\Comment::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'File' => null,
        'Type' => $faker->numberBetween(1,3),
        'Popularity' => $faker->numberBetween(1,100),
        'Account_id' => $faker->numberBetween(1,$seeder->accountNumber),
        'Post_id' => $faker->numberBetween(1,$seeder->postNumber),

    ];
});
$factory->define(\App\Notification::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'dateAndTime' => $faker->dateTime,
        'Seen' => $faker->boolean,
        'Post_id' => $faker->numberBetween(1,$seeder->postNumber),
        'Account_id' => $faker->numberBetween(1,$seeder->accountNumber)
    ];
});
$factory->define(\App\MessageNotification::class, function (Faker\Generator $faker) {
    $seeder = new seedNumber();
    return [
        'content' => $faker->word(100),
        'Seen' => $faker->boolean,
        'Message_id' => $faker->numberBetween(1,$seeder->messageNotificationNumber),
        'Account_id' => $faker->numberBetween(1,100)
    ];
});
$factory->define(\App\Conversation::class, function (Faker\Generator $faker) {
    return [
    ];
});
