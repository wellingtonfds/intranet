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
        factory(\App\User::class, 10)->create()->each(function ($user) {
            $user->roles()->attach([
                'role_id' => random_int(1, 4)
            ]);
        });
    }
}
