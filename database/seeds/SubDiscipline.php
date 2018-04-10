<?php

use Illuminate\Database\Seeder;

class SubDiscipline extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_disciplines')->insert([
            ['initial'=>'11','description'=>'ADMINISTRATIVO DA OBRA','discipline_id'=>11],
            ['initial'=>'02','description'=>'ARQUIVO TÉCNICO','discipline_id'=>8],
            ['initial'=>'06','description'=>'COMISSIONAMENTO','discipline_id'=>11],
            ['initial'=>'04','description'=>'CONTABILIDADE','discipline_id'=>1],
            ['initial'=>'08','description'=>'DATA BOOK','discipline_id'=>11],
            ['initial'=>'01','description'=>'DEPARTAMENTO PESSOAL','discipline_id'=>1],
            ['initial'=>'01','description'=>'ENGENHARIA','discipline_id'=>17],
            ['initial'=>'01','description'=>'ENGENHARIA','discipline_id'=>8],
            ['initial'=>'03','description'=>'FINANCEIRO','discipline_id'=>1],
            ['initial'=>'07','description'=>'FISCALIZAÇÃO','discipline_id'=>11],
            ['initial'=>'01','description'=>'geral','discipline_id'=>15],
            ['initial'=>'01','description'=>'geral','discipline_id'=>23],
            ['initial'=>'01','description'=>'geral','discipline_id'=>16],
            ['initial'=>'01','description'=>'geral','discipline_id'=>13],
            ['initial'=>'01','description'=>'geral','discipline_id'=>6],
            ['initial'=>'01','description'=>'geral','discipline_id'=>12],
            ['initial'=>'01','description'=>'geral','discipline_id'=>21],
            ['initial'=>'01','description'=>'geral','discipline_id'=>14],
            ['initial'=>'01','description'=>'geral','discipline_id'=>4],
            ['initial'=>'01','description'=>'geral','discipline_id'=>24],
            ['initial'=>'01','description'=>'geral','discipline_id'=>9],
            ['initial'=>'01','description'=>'geral','discipline_id'=>7],
            ['initial'=>'01','description'=>'geral','discipline_id'=>20],
            ['initial'=>'01','description'=>'geral','discipline_id'=>3],
            ['initial'=>'01','description'=>'geral','discipline_id'=>2],
            ['initial'=>'01','description'=>'geral','discipline_id'=>18],
            ['initial'=>'01','description'=>'geral','discipline_id'=>19],
            ['initial'=>'01','description'=>'geral','discipline_id'=>5],
            ['initial'=>'02','description'=>'GERENCIAMENTO','discipline_id'=>17],
            ['initial'=>'10','description'=>'GESTÃO DA QUALIDADE DA OBRA','discipline_id'=>11],
            ['initial'=>'05','description'=>'GESTÃO DE CUSTOS','discipline_id'=>1],
            ['initial'=>'02','description'=>'MATERIAL DE TREINAMENTO','discipline_id'=>19],
            ['initial'=>'09','description'=>'MEDIÇÃO TÉCNICA','discipline_id'=>11],
            ['initial'=>'02','description'=>'MEDICINA DO TRABALHO','discipline_id'=>22],
            ['initial'=>'03','description'=>'METODOLOGIA DOS CONTRATOS','discipline_id'=>10],
            ['initial'=>'01','description'=>'METODOLOGIA FACILITIES','discipline_id'=>10],
            ['initial'=>'02','description'=>'METODOLOGIA MEDIÇÃO','discipline_id'=>10],
            ['initial'=>'04','description'=>'RESPONSABILIDADE SOCIAL','discipline_id'=>11],
            ['initial'=>'02','description'=>'Segurança','discipline_id'=>11],
            ['initial'=>'01','description'=>'Segurança do trabalho','discipline_id'=>22],
            ['initial'=>'02','description'=>'SUPRIMENTOS','discipline_id'=>1],
            ['initial'=>'05','description'=>'SUPRIMENTOS','discipline_id'=>11],
        ]);
    }
}
