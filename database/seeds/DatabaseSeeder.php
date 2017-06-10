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
        $this->call(Permissions::class);
        $this->call(Roles::class);
        $this->call(Users::class);
        $this->call(Permission_role::class);
        $this->call(Role_user::class);
    }
}
