<?php

namespace App\Http\Controllers;

use App\Managers\SapiensCommunication;
use App\Post;
use App\Procedure;
use Carbon\Carbon;


class HomeController extends Controller
{
    use SapiensCommunication;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (env('ENABLE_LOGIN_LDAP'))
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
            ->where('publish', '=', true)
            ->limit(5)
            ->get();

        return view('home/home', [
            'lastProcedures' => $lastProcedures,
        ]);
    }

    /**
     * @return mixed
     */
    public function initial()
    {
        $birthDays = [];
        try {
            $birthDays = $this->getBirthdays();
        } catch (\Exception $e) {
            $birthDays = 'null';
        }
        $posts = Post::where('status_post_id', '=', 2)->orderBy('created_at', 'DESC')->paginate(5);
        return view('home', ['posts' => $posts, 'birthDays' => $birthDays]);
    }

    /**
     * @param $choice
     * @return mixed
     */
    public function centerOfCost($choice)
    {
        if ($choice == 'sede') {

            return view('home.sede', ['cc' => $this->getCenterOfCostSede()]);
        }


        $costs = [];
        try {
            $costs = $this->getCenterOfCost($choice);
        } catch (\Exception $e) {
            $costs = 'null';
        }

        return view('home.cost', ['costs' => $costs, 'choice' => $choice]);
    }
}
