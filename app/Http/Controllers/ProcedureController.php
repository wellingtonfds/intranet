<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\NotificationAdministrators;
use App\Jobs\SendReminderEmail;
use App\Mail\NewProcedure;
use App\Procedure;
use App\Revision;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProcedureController extends Controller
{
    public function index()
    {

        return view('procedure.index', [

            'procedures' => Procedure::paginate(15),
            'categories' => Category::all()
        ]);
    }

    public function details(Procedure $procedure)
    {
        $lastVersion = [
            "lastVersion" => $procedure->lastRevision()[0],
            "users" => [
                "elaborate" => "",
                "reviewed" => "",
                "approved" => ""
            ]
        ];
        if (!empty($lastVersion['lastVersion']->elaborate)) {
            $lastVersion['users']['elaborate'] = User::find($lastVersion['lastVersion']->elaborate);
        }
        if (!empty($lastVersion['lastVersion']->reviewed)) {
            $lastVersion['users']['reviewed'] = User::find($lastVersion['lastVersion']->reviewed);
        }
        if (!empty($lastVersion['lastVersion']->approved)) {
            $lastVersion['users']['approved'] = User::find($lastVersion['lastVersion']->approved);
        }
        return response()->json($data = [
            "procedure" => $procedure,
            "step" => $procedure->step(),
            "lastRevision" => $lastVersion,
            "category" => $procedure->category->name
        ]);
    }

    public function edit(Procedure $procedure)
    {
        $procedure->step = $procedure->step();
        $date = new Carbon($procedure->date_publish_finish);
        return $procedure;
    }

    public function store(Request $request, Procedure $procedure)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file' => 'mimes:pdf',
        ], [
            'name.required' => 'O nome é requerido.',
            'category_id.required' => 'A categoria é requerida.',
            'category_id.exists' => 'A categoria informada não existe.',
            'file.mimes' => 'A extensão do arquivo não foi aceita, utilizar apenas:pdf',
        ]);
        $procedure->name = $request->get('name');
        $procedure->categories_id = $request->get('category_id');
        $procedure->date_publish_finish = $request->get('date_publish_finish');
        $procedure->publish = $request->has('publish') ? true : false;
        $procedure->date_publish = $request->has('publish') ? Carbon::now() : null;
        if ($request->hasFile('file')) {
            $procedure->file = $request->file('file')->store('public/procedures');


        }
        $procedure->save();
        $procedure->revisions()->create([
            'elaborate_date' => Carbon::now(),
            'version' => 1,
            'elaborate' => Auth::user()->id,
            'description' => 'teste'
        ]);
        $email = new NewProcedure('Criação de procedimento', "O administrador(a) [user_name] criou o procedimento \" [procedure_name]  \". O mesmo necessita de revisão.<br><br>Obrigado");
        $email->subject("Criação de procedimento");
        dispatch(new NotificationAdministrators($procedure, $email));


        return $procedure;


    }

    public function update(Procedure $procedure, Request $request)
    {

        $this->validate($request, [
            'nameEdit' => 'required',
            'category_idEdit' => 'required|exists:categories,id',
            'file' => 'mimes:pdf',
        ], [
            'name.required' => 'O nome é requerido.',
            'category_id.required' => 'A categoria é requerida.',
            'category_id.exists' => 'A categoria informada não existe.',

            'file.mimes' => 'A extensão do arquivo não foi aceita, utilizar apenas:pdf',
        ]);
        $procedure->date_publish_finish = $request->get('date_publish_finish');
        $procedure->categories_id = $request->get('category_idEdit');
        $procedure->name = $request->get('nameEdit');
        if ($request->hasFile('file')) {
            $procedure->publish = 0;
            $procedure->date_publish = null;
            $procedure->file = $request->file('file')->store('public/procedures');
            $procedure->save();
            $procedure->revisions()->create([
                'elaborate_date' => Carbon::now(),
                'version' => count($procedure->revisions()) + 1,
                'elaborate', Auth::user()->id,
                'description' => 'teste'
            ]);
        } else {
            if ($procedure->step() == 'Aprovado') {

                $procedure->publish = $request->has('publishEdit') ? 1 : 0;
                $procedure->date_publish = $request->has('publishEdit') ? Carbon::now() : null;


            }
            $procedure->save();
        }


        return $procedure;
    }

    public function state(Procedure $procedure)
    {

        $lastRevision = $procedure->lastRevision();
        $lastRevision = Revision::find($lastRevision[0]->id);
        if (empty($lastRevision->reviewed)) {
            $lastRevision->reviewed = Auth::user()->id;
            $lastRevision->reviewed_date = Carbon::now();
            $lastRevision->save();
            $email = new NewProcedure('Revisão de procedimento', "O administrador(a) [user_name] revisou o procedimento \" [procedure_name]  \" O mesmo necessita de aprovação.<br><br>Obrigado(a)");
            $email->subject("Revisão de procedimento");
            dispatch(new NotificationAdministrators($procedure, $email));


        } elseif (empty($lastRevision->approved)) {
            $lastRevision->approved = Auth::user()->id;
            $lastRevision->approved_date = Carbon::now();
            $lastRevision->save();
            $email = new NewProcedure('Aprovação de procedimento', "O administrador(a)  [user_name] aprovou o procedimento \" [procedure_name] \" O mesmo já pode ser publicado.<br><br>Obrigado(a)");
            $email->subject("Aprovação de procedimento");
            dispatch(new NotificationAdministrators($procedure, $email));


        }
        return $lastRevision;
    }

    public function destroy(Procedure $procedure)
    {
        $procedure->delete();
        return $procedure;
    }

    public function notification(Procedure $procedure, Request $request)
    {
        $validator = Validator::make($request->all(), [], []);
        $validator->after(function ($validator) use ($procedure) {
            if ($procedure->step() != 'Aprovado' && $procedure->publish) {
                $validator->errors()->add('Procedimento', 'Não é possivel notificar os usuários para ler um procedimento não revisado!');
            }
        });
        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }
        dispatch(new SendReminderEmail($procedure, Auth::user()));
        return $procedure;
    }

    public function publishfinish()
    {
        $procedures = Procedure::where('date_publish_finish', '<', Carbon::now()->format('Y-m-d'))
            ->where('publish', '=', true)
            ->get();
        foreach ($procedures as $procedure):
            $procedure->date_publish_finish = null;
            $procedure->publish = false;
            $procedure->save();
        endforeach;


    }

    public function text(Procedure $procedure)
    {
        return view('procedure.text', [
            'procedure' => $procedure
        ]);

    }
    public function saveText(Procedure $procedure,Request $request)
    {
        $procedure->text = $request->get('text');
        $procedure->save();
        return $procedure;
    }
}
