<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        //获取除了 1 的 id 数组
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        // 1 关注除 1 外所有用户
        $user->follow($follower_ids);

        //除 1 外所有用户关注 1
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
