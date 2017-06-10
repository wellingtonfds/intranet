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
        $data = [
            ['name' => str_random(10), 'email' => 'insert@gmail.com', 'password' => bcrypt('123456')],
            ['name' => str_random(10), 'email' => 'update@gmail.com', 'password' => bcrypt('123456')],
            ['name' => str_random(10), 'email' => 'delete@gmail.com', 'password' => bcrypt('123456')],
            ['name' => str_random(10), 'email' => 'admin@gmail.com', 'password' => bcrypt('123456')]
        ];
        DB::table('users')->insert($data);
    }
}
