<?php

namespace App\Http\Controllers;

use App\Category;
use App\Procedure;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function index(){
        return view('procedure.index',[
            'procedures'=>Procedure::paginate(15),
            'categories'=>Category::all()
        ]);
    }

    public function store(Request $request,Procedure $procedure){


        $this->validate($request,[
            'name'=>'required',
            'category_id'=>'required|exists:categories,id',
            'file'=>'required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ],[
            'name.required'=>'O nome é requerido.',
            'category_id.required'=>'A categoria é requerida.',
            'category_id.exists'=>'A categoria informada não existe.',
            'file.required'=>'A arquivo é requerido.',
            'file.mimes'=>'A extensão do arquivo não foi aceita, utilizar apenas:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ]);


        $procedure->name = $request->get('name');
        $procedure->categories_id = $request->get('category_id');
        $procedure->date_publish_finish = $request->get('date_publish_finish');
        $procedure->publish = $request->has('publish')? true:false;
        $procedure->download = $request->has('download')? true:false;
        $procedure->date_publish = $request->has('publish')? Carbon::now():null;
        $procedure->file = $request->file('file')->store('public/procedures');
        $procedure->save();
        return $procedure;



    }
}
