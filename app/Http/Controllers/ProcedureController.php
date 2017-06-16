<?php

namespace App\Http\Controllers;

use App\Category;
use App\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function index(){
        return view('procedure.index',[
            'procedures'=>Procedure::paginate(15),
            'categories'=>Category::all()
        ]);
    }
}
