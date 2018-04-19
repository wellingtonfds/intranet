<?php

use Illuminate\Database\Seeder;

class Categorization extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorizations')->insert([
            ['description'=>'ADM 2','discipline_id'=>22,'sub_discipline_id'=>34],
            ['description'=>'ALMOXARIFADO','discipline_id'=>11,'sub_discipline_id'=>42],
            ['description'=>'ANDAIMES','discipline_id'=>11,'sub_discipline_id'=>10],
            ['description'=>'DP','discipline_id'=>1,'sub_discipline_id'=>9],
            ['description'=>'COMPRAS','discipline_id'=>11,'sub_discipline_id'=>42],
            ['description'=>'DILIGENCIAMENTO E INSPEÇÃO','discipline_id'=>11,'sub_discipline_id'=>42],
            ['description'=>'ELÉTRICA','discipline_id'=>11,'sub_discipline_id'=>10],
            ['description'=>'GERAL','discipline_id'=>11,'sub_discipline_id'=>38],
            ['description'=>'GERAL','discipline_id'=>24,'sub_discipline_id'=>20],
            ['description'=>'GERAL','discipline_id'=>17,'sub_discipline_id'=>7],
            ['description'=>'GERAL','discipline_id'=>4,'sub_discipline_id'=>19],
            ['description'=>'GERAL','discipline_id'=>5,'sub_discipline_id'=>28],
            ['description'=>'GERAL','discipline_id'=>7,'sub_discipline_id'=>22],
            ['description'=>'GERAL','discipline_id'=>9,'sub_discipline_id'=>21],
            ['description'=>'GERAL','discipline_id'=>19,'sub_discipline_id'=>27],
            ['description'=>'GERAL','discipline_id'=>20,'sub_discipline_id'=>23],
            ['description'=>'GERAL','discipline_id'=>15,'sub_discipline_id'=>11],
            ['description'=>'GERAL','discipline_id'=>2,'sub_discipline_id'=>25],
            ['description'=>'GERAL','discipline_id'=>18,'sub_discipline_id'=>26],
            ['description'=>'GERAL','discipline_id'=>11,'sub_discipline_id'=>5],
            ['description'=>'GERAL','discipline_id'=>23,'sub_discipline_id'=>12],
            ['description'=>'GERAL','discipline_id'=>14,'sub_discipline_id'=>18],
            ['description'=>'GERAL','discipline_id'=>10,'sub_discipline_id'=>37],
            ['description'=>'GERAL','discipline_id'=>10,'sub_discipline_id'=>35],
            ['description'=>'GERAL','discipline_id'=>10,'sub_discipline_id'=>36],
            ['description'=>'GERAL','discipline_id'=>19,'sub_discipline_id'=>32],
            ['description'=>'GERAL','discipline_id'=>11,'sub_discipline_id'=>30],
            ['description'=>'GERAL','discipline_id'=>11,'sub_discipline_id'=>33],
            ['description'=>'GERAL','discipline_id'=>11,'sub_discipline_id'=>3],
            ['description'=>'GERAL','discipline_id'=>12,'sub_discipline_id'=>16],
            ['description'=>'GERAL','discipline_id'=>6,'sub_discipline_id'=>15],
            ['description'=>'GERAL','discipline_id'=>13,'sub_discipline_id'=>14],
            ['description'=>'GERAL','discipline_id'=>16,'sub_discipline_id'=>13],
            ['description'=>'GERAL','discipline_id'=>8,'sub_discipline_id'=>8],
            ['description'=>'GERAL','discipline_id'=>8,'sub_discipline_id'=>2],
            ['description'=>'GERAL','discipline_id'=>1,'sub_discipline_id'=>41],
            ['description'=>'GERAL','discipline_id'=>22,'sub_discipline_id'=>40],
            ['description'=>'GERAL','discipline_id'=>22,'sub_discipline_id'=>34],
            ['description'=>'GERAL','discipline_id'=>21,'sub_discipline_id'=>17],
            ['description'=>'GERAL','discipline_id'=>17,'sub_discipline_id'=>29],
            ['description'=>'GERAL','discipline_id'=>1,'sub_discipline_id'=>6],
            ['description'=>'GERAL','discipline_id'=>1,'sub_discipline_id'=>4],
            ['description'=>'GERAL','discipline_id'=>1,'sub_discipline_id'=>9],
            ['description'=>'GERAL','discipline_id'=>1,'sub_discipline_id'=>31],
            ['description'=>'GESTÃO DA SEGURANÇA','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'GESTÃO DE CONTRATADAS','discipline_id'=>11,'sub_discipline_id'=>1],
            ['description'=>'GESTÃO DE CONTRATOS','discipline_id'=>17,'sub_discipline_id'=>29],
            ['description'=>'GESTÃO DE PESSOAS','discipline_id'=>11,'sub_discipline_id'=>1],
            ['description'=>'GESTÃO DE QUALIDADE OBRAS	','discipline_id'=>11,'sub_discipline_id'=>1],
            ['description'=>'GESTÃO DE RECURSOS/CUSTOS','discipline_id'=>11,'sub_discipline_id'=>1],
            ['description'=>'GESTÃO DE TRANSPORTE','discipline_id'=>11,'sub_discipline_id'=>1],
            ['description'=>'GESTÃO DE TREINAMENTOS','discipline_id'=>11,'sub_discipline_id'=>1],
            ['description'=>'GESTÃO DO PROJETO','discipline_id'=>11,'sub_discipline_id'=>10],
            ['description'=>'IÇAMENTO','discipline_id'=>11,'sub_discipline_id'=>10],
            ['description'=>'LOGÍSTICA','discipline_id'=>11,'sub_discipline_id'=>42],
            ['description'=>'MÁQUINAS, EQUIPAMENTOS E ÁREAS DE TRABALHO','discipline_id'=>11,'sub_discipline_id'=>10],
            ['description'=>'NR1 - DISPOSIÇÕES GERAIS','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR11 - TRANSPORTE, MOVIMENTAÇÃO, ARMAZENAGEM','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR12 - SEGURANÇA TRABALHO MÁQUINAS EQUIPAMENT','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR15 - ATIVIDADES E OPERAÇÕES INSALBRES','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR16 - ATIVIDADES E OPERAÇÕES PERIGOSAS','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR17 - ERGONOMIA','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR18 - CONDIÇÕES E M.A. NA IND. DA CONSTRUÇÃO','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR2 - INSPEÇÕES PRÉVIAS','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR22 - SEGURANÇA E SAÚDE OCUPACIONAL NA MINER','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR23 - PROTEÇÃO CONTRA INCÊNDIO','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR24 - CONDIÇÕES SANITÁRIAS E DE CONFORTO','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR26 - SINALIZAÇÃO DE SEGURANÇA','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR3 - EMBARGO E INTERDIÇÃO','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR33 - SEG. ESPAÇOS CONFINADOS','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR35 - TRABALHO EM ALTURA','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR4 - SESMT','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR5 - CIPA','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR6 - EPI','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR7 - PCMSO','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR8 - EDIFICAÇÕES','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'NR9 - PPRA','discipline_id'=>11,'sub_discipline_id'=>39],
            ['description'=>'OBRAS CIVIS','discipline_id'=>11,'sub_discipline_id'=>10],
            ['description'=>'OPERAÇÃO','discipline_id'=>11,'sub_discipline_id'=>10],
            ['description'=>'sadasdasd','discipline_id'=>1,'sub_discipline_id'=>4],
            ['description'=>'TOPOGRAFIA','discipline_id'=>11,'sub_discipline_id'=>10],
            ['description'=>'TRANSPORTE DE CARGAS E MATERIAIS','discipline_id'=>11,'sub_discipline_id'=>10],
        ]);
    }
}