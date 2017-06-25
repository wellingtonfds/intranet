<?php

namespace App\Http\Controllers;

use App\Category;
use App\Procedure;
use App\Revision;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcedureController extends Controller
{
    public function index()
    {
        return view('procedure.index', [
            'procedures' => Procedure::paginate(15),
            'categories' => Category::all()
        ]);
    }
    public function details(Procedure $procedure){
        $lastVersion = [
            "lastVersion"=>$procedure->lastRevision()[0],
            "users"=>[
                "elaborate"=>"",
                "reviewed"=>"",
                "approved"=>""
            ]
        ];
        if(!empty($lastVersion['lastVersion']->elaborate)){
            $lastVersion['users']['elaborate'] = User::find($lastVersion['lastVersion']->elaborate);
        }
        if(!empty($lastVersion['lastVersion']->reviewed)){
            $lastVersion['users']['reviewed']= User::find($lastVersion['lastVersion']->reviewed);
        }
        if(!empty($lastVersion['lastVersion']->approved)){
            $lastVersion['users']['approved']= User::find($lastVersion['lastVersion']->approved);
        }
        return response()->json($data = [
            "procedure"=>$procedure,
            "step"=>$procedure->step(),
            "lastRevision"=>$lastVersion,
            "category"=>$procedure->category->name
        ]);
    }
    public function store(Request $request, Procedure $procedure)
    {

        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ], [
            'name.required' => 'O nome é requerido.',
            'category_id.required' => 'A categoria é requerida.',
            'category_id.exists' => 'A categoria informada não existe.',
            'file.required' => 'A arquivo é requerido.',
            'file.mimes' => 'A extensão do arquivo não foi aceita, utilizar apenas:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ]);


        $procedure->name = $request->get('name');
        $procedure->categories_id = $request->get('category_id');
        $procedure->date_publish_finish = $request->get('date_publish_finish');
        $procedure->publish = $request->has('publish') ? true : false;
        $procedure->download = $request->has('download') ? true : false;
        $procedure->date_publish = $request->has('publish') ? Carbon::now() : null;
        $procedure->file = $request->file('file')->store('public/procedures');
        $procedure->save();
        $procedure->revisions()->create([
            'elaborate_date'=>Carbon::now(),
            'version'=>1,
            'elaborate',Auth::user()->id,
            'description'=>'teste'
        ]);


    }

    public function state(Procedure $procedure)
    {
        $lastRevision = $procedure->lastRevision();
        $lastRevision = Revision::find($lastRevision[0]->id);


        if(empty($lastRevision->reviewed)){
            $lastRevision->reviewed = Auth::user()->id;
            $lastRevision->reviewed_date = Carbon::now();
            $lastRevision->save();
        }elseif(empty($lastRevision->approved)){
            $lastRevision->approved = Auth::user()->id;
            $lastRevision->approved_date = Carbon::now();
            $lastRevision->save();
        }
        return $lastRevision;
    }
}
