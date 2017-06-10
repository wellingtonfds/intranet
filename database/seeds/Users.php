<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$data = [
            ['name' => str_random(10), 'email' => 'user1@vale.com', 'password' => bcrypt('123456')],
            ['name' => str_random(10), 'email' => 'user2@vale.com', 'password' => bcrypt('123456')],
            ['name' => str_random(10), 'email' => 'user3@vale.com', 'password' => bcrypt('123456')],
            ['name' => str_random(10), 'email' => 'admin@vale.com', 'password' => bcrypt('123456')]
        ];
        DB::table('users')->insert($data);*/

        factory(\App\User::class,10)->create()->each(function($user){
            $user->roles()->attach([
               'role_id'=>random_int(1,4)
            ]);
        });
    }
}
