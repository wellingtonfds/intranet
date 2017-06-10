<?php

use Illuminate\Database\Seeder;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name"=>"insert","label"=>"Acesso para inserir"],
            ["name"=>"update","label"=>"Acesso para atualizar"],
            ["name"=>"deletar","label"=>"Acesso para deletar"],
            ["name"=>"admin","label"=>"Acesso a tudo"]
        ];
        DB::table('permissions')->insert($data);
    }
}
