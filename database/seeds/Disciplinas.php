<?php

use App\Discipline;
use Illuminate\Database\Seeder;

class Disciplinas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description'=>'ADMINISTRATIVO','business_unit'=>'Administrativo'],
            ['description'=>'ARQUITETURA','business_unit'=>'Engenharia'],
            ['description'=>'AUTOMAÇÃO','business_unit'=>'Engenharia'],
            ['description'=>'COMERCIALIZAÇÃO E PROPOSTAS','business_unit'=>'Administrativo'],
            ['description'=>'CONCRETO','business_unit'=>'Engenharia'],
            ['description'=>'DOCUMENTAÇÃO','business_unit'=>'Administrativo'],
            ['description'=>'ELÉTRICA','business_unit'=>'Engenharia'],
            ['description'=>'ENGENHARIA','business_unit'=>'Engenharia'],
            ['description'=>'ESTRUTURA METÁLICA','business_unit'=>'Engenharia'],
            ['description'=>'FACILITIES','business_unit'=>'Facilities'],
            ['description'=>'GERENCIAMENTO','business_unit'=>'Gerenciamento'],
            ['description'=>'IMPLANTAÇÃO CIVIL','business_unit'=>'Engenharia'],
            ['description'=>'INFORMÁTICA','business_unit'=>'Administrativo'],
            ['description'=>'INSTITUCIONAL','business_unit'=>'Administrativo'],
            ['description'=>'MECÂNICA','business_unit'=>'Engenharia'],
            ['description'=>'MEIO AMBIENTE','business_unit'=>'Administrativo'],
            ['description'=>'PLANEJAMENTO','business_unit'=>'Gerenciamento'],
            ['description'=>'PROCESSO','business_unit'=>'Engenharia'],
            ['description'=>'QUALIDADE','business_unit'=>'Administrativo'],
            ['description'=>'RECURSOS HUMANOS','business_unit'=>'Administrativo'],
            ['description'=>'SERVIÇOS GERAIS','business_unit'=>'Administrativo'],
            ['description'=>'SESMT','business_unit'=>'Administrativo'],
            ['description'=>'SISTEMAS','business_unit'=>'Engenharia'],
            ['description'=>'TUBULAÇÃO','business_unit'=>'Engenharia'],
        ];
        DB::table('Disciplines')->insert($data);
    }
}
