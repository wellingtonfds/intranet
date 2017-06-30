<?php

namespace App\Http\Controllers;

use App\Procedure;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lastProcedures = $lastProcedures = Procedure::where('date_publish', '<', Carbon::now()->addDays(5))
            ->where('publish','=',true)
            ->limit(5)
            ->get();
        return view('home/home',[
            'lastProcedures'=>$lastProcedures
        ]);
    }
}
