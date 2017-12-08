<?php

namespace App\Http\Controllers;

use App\Post;
use App\Procedure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(env('ENABLE_LOGIN_LDAP'))
            $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastProcedures = $lastProcedures = Procedure::where('date_publish', '>', Carbon::now()->subDays(5))
            ->where('publish','=',true)
            ->limit(5)
            ->get();
        return view('home/home',[
            'lastProcedures'=>$lastProcedures,
        ]);
    }

    public function initial(){
        return view('home',['posts'=>Post::where('status_post_id','=',2)->paginate(5)]);
    }

    public function bday(){
        $sql = "
  SELECT top 10 CAST(day(vetorh..r034fun.datnas) AS VARCHAR(2)) + '/' + CAST(month(vetorh..r034fun.datnas) AS VARCHAR(2)),
       upper(vetorh..r034fun.nomfun),
       vetorh..r016orn.nomloc
  FROM vetorh..r034fun, vetorh..r010sit, vetorh..r016orn 
 WHERE vetorh..R034FUN.numemp = 1      -- EMPRESA LYON
   AND vetorh..R034FUN.sitafa <> 7     -- DEMITIDOS 
   AND MONTH(vetorh..R034FUN.datnas) = MONTH(getdate())
   AND DAY(vetorh..R034FUN.DATNAS) = DAY(GETDATE())
   AND vetorh..r010sit.CodSit = vetorh..r034fun.sitafa
   AND vetorh..r016orn.numloc = vetorh..r034fun.numloc
ORDER BY vetorh..R034FUN.nomfun";

        $acesso = DB::connection('sqlsrv')->select(DB::raw($sql));
        dd($acesso);
        return "Ok";
    }
}
