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
        // $this->call(UsersTableSeeder::class);
        /*factory(\App\Account::class, 100)->create();
        factory(\App\Grp::class, 20)->create();
        factory(\App\Post::class, 10)->create();
        factory(\App\Comment::class, 30)->create();
        factory(\App\Message::class, 30)->create();
        factory(\App\Notification::class, 40)->create();
        factory(\App\MessageNotification::class, 40)->create();
        factory(\App\Conversation::class, 30)->create();

        $conversationIds= DB::table('conversations')->pluck('id');
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


    }
}
