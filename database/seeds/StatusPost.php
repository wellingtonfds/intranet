<?php

use Illuminate\Database\Seeder;

class StatusPost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["status"=>"rascunho"],
            ["status"=>"publicado"],
            ["status"=>"apagado"],
            ["status"=>"invisivel"],

        ];
        DB::table('status_post')->insert($data);
    }
}
