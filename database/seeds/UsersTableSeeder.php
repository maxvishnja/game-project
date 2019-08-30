<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Super Administrator';
        $user->email = 'admin@admin.com';
        $user->type = 'admin';
        $user->password = bcrypt('admin2019');
        $user->remember_token = str_random(10);
        $user->save();
    }
}
