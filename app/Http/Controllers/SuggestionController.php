<?php

namespace App\Http\Controllers;

use App\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    public function index()
    {
        return view('suggestion.index', [
            'suggestions' => Suggestion::paginate(15)
        ]);
    }

    public function store(Request $request, Suggestion $suggestion)
    {

        $this->validate($request, [
            'suggestion' => 'required',
            'procedure_id' => 'required'
        ], [
            'suggestion.required' => 'O campo sugestão não pode ficar em branco',
            'procedure_id.required' => 'O id do procedimento é requerido'
        ]);
        $suggestion->procedure_id = $request->get('procedure_id');
        $suggestion->suggestion = $request->get('suggestion');
        $suggestion->requester = Auth::user()->id;
        $suggestion->stage = $request->get('stage');
        $suggestion->save();
        return $suggestion;
    }

    public function destroy(Suggestion $suggestion)
    {
        $suggestion->delete();
        return $suggestion;
    }
}
