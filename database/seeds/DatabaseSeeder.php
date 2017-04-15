<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = \Faker\Factory::create() ; // Faker generator
        $seeder = new \App\Services\v1\seedNumber();  // seeder default numbers

        /*factory(\App\Account::class, $seeder->accountNumber)->create();
        factory(\App\Grp::class, $seeder->groupNumber)->create();
        factory(\App\Poll::class, $seeder->pollNumber)->create();
        factory(\App\Post::class, $seeder->postNumber)->create();
        factory(\App\Comment::class, $seeder->commentNumber)->create();
        factory(\App\Message::class, $seeder->messageNumber)->create();
        factory(\App\Notification::class, $seeder->notificationNumber)->create();
        factory(\App\MessageNotification::class, $seeder->messageNotificationNumber)->create();
        factory(\App\Conversation::class, $seeder->conversationNumber)->create();


        $conversationIds= DB::table('conversations')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($conversationIds as $conversationId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            var_dump($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 5; $index++) {
                $pivots[] = [
                    'Conversation_id' => $conversationId,
                    'Account_id' => array_shift($array)
                ];
            }
        }
        DB::table('account_conversation')->insert($pivots);

        $groupIds= DB::table('grps')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($groupIds as $groupId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 5; $index++) {
                   $pivots[] = [
                        'Grp_id' => $groupId,
                        'Account_id' => array_shift($array)
                   ];
            }
        }
        DB::table('grp_account')->insert($pivots);

        $groupIds= DB::table('grps')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($groupIds as $groupId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 6; $index++) {
                $pivots[] = [
                    'Grp_id' => $groupId,
                    'Account_id' => array_shift($array)
                ];
            }
        }
        DB::table('account_grp')->insert($pivots);

        $pollIds= DB::table('polls')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($pollIds as $pollId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 7; $index++) {
                $pivots[] = [
                    'Poll_id' => $pollId,
                    'Account_id' => array_shift($array)
                ];
            }
        }
        DB::table('account_poll')->insert($pivots);



        $commentIds= DB::table('comments')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($commentIds as $commentId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 10; $index++) {
                $pivots[] = [
                    'Comment_id' => $commentId,
                    'Account_id' => array_shift($array),
                    'Type' => $faker->numberBetween(1,$seeder->reactionType)
                ];
            }
        }
        DB::table('account_comment')->insert($pivots);

        $postIds= DB::table('posts')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($postIds as $postId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
                for($index = 0; $index < 100; $index++) {
                $pivots[] = [
                    'Post_id' => $postId,
                    'Account_id' => array_shift($array),
                    'Type' => $faker->numberBetween(1,$seeder->reactionType)

                ];
            }
        }
        DB::table('account_post')->insert($pivots);

        $pollIds= DB::table('polls')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($pollIds as $pollId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 100; $index++) {
                $pivots[] = [
                    'poll_id' => $pollId,
                    'Account_id' => array_shift($array),
                ];
            }
        }
        DB::table('account_poll')->insert($pivots);*/

    }
}
