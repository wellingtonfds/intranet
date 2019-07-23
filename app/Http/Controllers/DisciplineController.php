<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Document;
use App\SubDiscipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisciplineController extends Controller
{
    /**
     * @return mixed
     */
    public function index(){
        return Discipline::all();
    }

    /**
     * @param Discipline $discipline
     * @return mixed
     */
    public  function subDiscipline(Discipline $discipline){
        return $discipline->subDiscipline;
    }

    /**
     * @param Discipline $discipline
     * @param SubDiscipline $subDiscipline
     * @return mixed
     */
    public  function category(Discipline $discipline,SubDiscipline $subDiscipline){
        return DB::table('categorizations')->where('discipline_id',$discipline->id)->where('sub_discipline_id',$subDiscipline->id)->get();
    }

    /**
     * @param Request $request
     * @param Document $document
     * @return Document
     */
    public function store(Request $request,Document $document){
        $this->validate($request,[
           'file'=>'required',
           'categorization_id'=>'required',
           'discipline_id'=>'required',
           'sub_discipline_id'=>'required',
           'title'=>'required',
           'type'=>'required'
        ]);
        $document->fill($request->all());
        $document->file = $request->file('file')[0]->store('public/document');
        $document->save();
        return $document;
            //return $request->file('file')[0]->store('public/document');

    }
}
