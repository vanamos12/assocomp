<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create(){
        $fonctions = User::FONCTION;
        return view('admin.users.create', compact('fonctions'));
    }

    public function store(CreateUserRequest $request){
        return redirect()->route('users');
    }
}
