<?php
/**
 * Created by PhpStorm.
 * User: Wellington
 * Date: 09/12/2017
 * Time: 22:07
 */

namespace App\Managers;


use Illuminate\Support\Facades\DB;

trait SapiensCommunication
{
    /**
     * @return mixed
     * @throws \Exception
     */
    protected function getBirthdays(){

        $sql = "
            SELECT vetorh..r034fun.datnas,
              vetorh..r034fun.nomfun,
              vetorh..r016orn.nomloc
            FROM vetorh..r034fun, vetorh..r010sit, vetorh..r016orn 
            WHERE vetorh..R034FUN.numemp = 1      -- EMPRESA LYON
            AND vetorh..R034FUN.sitafa <> 7     -- DEMITIDOS 
            AND MONTH(vetorh..R034FUN.datnas) = MONTH(getdate())
            AND DAY(vetorh..R034FUN.DATNAS) = DAY(GETDATE())
            AND vetorh..r010sit.CodSit = vetorh..r034fun.sitafa
            AND vetorh..r016orn.numloc = vetorh..r034fun.numloc
            ORDER BY vetorh..R034FUN.nomfun
        ";
        try{
            return DB::connection('sqlsrv')->select(DB::raw($sql));
        }catch (\Exception $ex){
            throw new \Exception("Sem conexão com banco de dados");
        }
    }

    /**
     * Choice Facilities or Gerenciamento
     */
    protected function getCenterOfCost($choice){
        $today = date('m/d/Y');
        $sql = "
        SELECT usu_t100ccu.usu_codccu AS 'Usu_CodCcu', 
        E044CCU.DesCcu AS 'Usu_DesCcu',
        E085cto.usu_codcar AS 'Usu_CodCar',
        E085CTO.usu_codent AS 'Usu_CodEnt',
        E085CTO.NomCto AS 'Usu_NomCto',
        --R900CPL.EMAIL,
        MAX(usu_t100con.usu_datbas) AS 'Usu_DatBas'
        FROM sapiens..usu_t100ccu, sapiens..usu_t100con, sapiens..e044ccu, sapiens..e085cto, sapiens..r900cpl
   WHERE usu_t100ccu.usu_codemp = 1 
    AND usu_t100ccu.usu_codemp = usu_t100con.usu_codemp
    AND usu_t100ccu.usu_codccu = usu_t100con.usu_codccu
    AND usu_t100ccu.usu_sitctr <> 'I'
    AND e044ccu.CodEmp = usu_t100ccu.usu_codemp 
    AND e044ccu.CodCcu = usu_t100ccu.usu_codccu  
    AND (E044CCU.DesCcu LIKE '%$choice%')
    AND e085cto.CodCli = usu_t100con.usu_empcon
    AND e085cto.SeqCto = usu_t100con.usu_codcon
    AND e085cto.usu_codcar IN (1,2,5,9)
    AND e085cto.codniv = 5
    AND usu_t100con.usu_datbas = (SELECT MAX(A.usu_datbas)       
                                    FROM sapiens..usu_t100con A,              
                                         sapiens..e085cto B                   
                                   WHERE A.usu_codemp = usu_t100con.usu_codemp 
                                     AND A.usu_codccu = usu_t100con.usu_codccu 
                                     AND A.usu_empcon = 60                     
                                     AND B.codcli = 60                         
                                     AND B.sitcto = 'A'                        
                                     AND B.codniv = 5                          
                                     AND A.usu_empcon = B.codcli               
                                     AND A.usu_codcon = B.seqcto               
                                     AND A.usu_datbas <= '$today' ) 
    GROUP BY usu_t100ccu.usu_codccu,
             E085CTO.NomCto,
             E044CCU.DesCcu,
             usu_t100con.usu_datbas,
             E085cto.usu_codcar,
             E085CTO.usu_codent
        ";
        try{
            return DB::connection('sqlsrv')->select(DB::raw($sql));
        }catch (\Exception $ex){
            throw new \Exception("Sem conexão com banco de dados");
        }
    }



}