<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('auth.index',[
            'users'=>User::paginate(15),
            'roles'=>Role::all()
        ]);
    }
    public function store(Request $request,User $user){
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'permission'=> 'required|exists:roles,id'
        ]);

        $user->name = $request->name;
        $user->password = bcrypt($request->get('password'));
        $user->email = $request->get('email');
        $user->save();
        $user->roles()->attach([
            'role_id'=>$request->get('permission')
        ]);
        return $user;
    }

    public function edit(User $user){
        $user->roles = $user->roles[0];
        return $user;
    }

    public function update(User $user,Request $request){

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'string|min:6|confirmed',
            'permission'=> 'required|exists:roles,id'
        ]);
        $user->roles()->detach();
        $user->name = $request->name;
        if($request->has('password')){
            $user->password = bcrypt($request->get('password'));
        }
        $user->email = $request->get('email');
        $user->save();
        $user->roles()->attach([
            'role_id'=>$request->get('permission')
        ]);
        return $user;

    }

    public function destroy(User $user){
        if(Auth::user()->id == $user->id){
            abort(403,'Você não pode apagar seu usuário');
        }
        $user->delete();
        return $user;
    }
}
