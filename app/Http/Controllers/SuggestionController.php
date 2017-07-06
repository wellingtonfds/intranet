<?php

namespace App\Http\Controllers;

use App\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    public function index(){
        return view('suggestion.index',[
           'suggestions'=>Suggestion::paginate(15)
        ]);
    }
    public function store(Request $request,Suggestion $suggestion){

        $this->validate($request,[
           'suggestion'=>'required'
        ],[
            'suggestion.required'=>'O campo sugestão não pode ficar em branco'
        ]);
        $suggestion->suggestion = $request->get('suggestion');
        $suggestion->requester = Auth::user()->id;
        $suggestion->save();
        return $suggestion;
    }
    public function destroy(Suggestion $suggestion){
        $suggestion->delete();
        return $suggestion;
    }
}
