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
        $this->call(Permission_role::class);
        $this->call(Users::class);
        $this->call(Category::class);
        $this->call(StatusPost::class);
        $this->call(Disciplinas::class);
        $this->call(SubDiscipline::class);

    }
}
