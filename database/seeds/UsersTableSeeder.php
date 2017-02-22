<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->toArray());

        $user = User::find(1);
        $user->name = 'Terry1';
        $user->email = 'terry.ehj@gmail.com';
        $user->password = bcrypt('111111');
        $user->is_admin = true;
        $user->activated = true;
        $user->save();

        $user = User::find(2);
        $user->name = 'Terry2';
        $user->email = 'terry_ehj@163.com';
        $user->password = bcrypt('111111');
        $user->is_admin = false;
        $user->activated = true;
        $user->save();
    }
}
