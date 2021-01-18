<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        return view("user.index");
    }

    public function edit(){
        $user = auth()->user();
        return view("user.edit", compact("user"));
    }

    public function update(Request $request){
        $request->validate([
            "name" => ["required", "max:250"],
            "email" => ["required", "email"],
            "password" => ["required", "min:8", "confirmed"]
        ]);
        $user = User::where("email", $request["email"])->first();
        if (!isset($user)){
            $user = User::find(auth()->user()->id);
        }
        if($user->id != auth()->user()->id){
            return redirect()->back()->withErrors( "Аккаунт с таким E-mail адресом уже существует");
        }
        else{
            $request["password"] = Hash::make($request["password"]);
            $user->update($request->all());
            auth()->attempt(["email" => $request["email"], "password" => $request["password"]]);
            return redirect()->route("user.index");
        }
    }

}
