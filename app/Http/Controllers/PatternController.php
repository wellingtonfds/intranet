<?php

namespace App\Http\Controllers;

use App\Post;
use App\Document;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Managers\SapiensCommunication;
use Illuminate\Support\Facades\Storage;

class PatternController extends Controller
{
    use SapiensCommunication;
    public function index(){
        if(Auth::check())
            return view('pattern.index');
        $birthDays =[];
        try{
            $birthDays = $this->getBirthdays();
        }catch (\Exception $e){
            $birthDays = 'null';
        }
        $posts = Post::where('status_post_id','=',2)->orderBy('created_at','DESC')->paginate(5);
        return view('pattern.index',['posts'=>$posts,'birthDays'=>$birthDays]);
    }

    public function store(Document $document,Request $request){
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
    }
    public function update(Request $request,Document $document){
        $document->fill($request->all());
        if($request->hasFile('file')){
            $document->file = $request->file('file')[0]->store('public/document');
        }
        $document->save();
        return $document;
    }

    public function listDocuments(){
        $documents =  Document::with('Discipline')->with('SubDiscipline')->with('Category')->get();
        return $documents;
    }
    public function destroy(Document $document){
        $document->delete();
        return $document;
    }
    public function show(Document $document){
        //dd($document);
        $path = str_replace('/','\\',$document->file);
        return response()->download(storage_path('app\\'.$path));
        
    }
}
