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
        $faker  = \Faker\Factory::create() ;

        // $this->call(UsersTableSeeder::class);
        /*factory(\App\Account::class, 100)->create();
        factory(\App\Grp::class, 20)->create();
        factory(\App\Post::class, 10)->create();
        factory(\App\Comment::class, 30)->create();
        factory(\App\Message::class, 30)->create();
        factory(\App\Notification::class, 40)->create();
        factory(\App\MessageNotification::class, 40)->create();
        factory(\App\Conversation::class, 30)->create();*/

        /*$conversationIds= DB::table('conversations')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($conversationIds as $conversationId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            var_dump($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 3; $index++) {
                $pivots[] = [
                    'Conversation_id' => $conversationId,
                    'Account_id' => array_shift($array)
                ];
            }
        }
        DB::table('account_conversation')->insert($pivots);*/

        /*$groupIds= DB::table('grps')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($groupIds as $groupId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 3; $index++) {
                   $pivots[] = [
                        'Grp_id' => $groupId,
                        'Account_id' => array_shift($array)
                   ];
            }
        }
        DB::table('grp_account')->insert($pivots);*/
        /*$groupIds= DB::table('grps')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($groupIds as $groupId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 3; $index++) {
                $pivots[] = [
                    'Grp_id' => $groupId,
                    'Account_id' => array_shift($array)
                ];
            }
        }
        DB::table('account_grp')->insert($pivots);*/

        /*$pollIds= DB::table('polls')->pluck('id');
        $accountIds= DB::table('accounts')->pluck('id');
        $pivots = [];
        foreach($pollIds as $pollId)
        {
            $randomizedCarIds = $accountIds;
            $array = iterator_to_array($randomizedCarIds);
            shuffle($array);
            for($index = 0; $index < 5; $index++) {
                $pivots[] = [
                    'Poll_id' => $pollId,
                    'Account_id' => array_shift($array)
                ];
            }
        }
        DB::table('account_poll')->insert($pivots);*/


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
                    'Type' => $faker->boolean
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
                    'Type' => $faker->boolean

                ];
            }
        }
        DB::table('account_post')->insert($pivots);

    }
}
