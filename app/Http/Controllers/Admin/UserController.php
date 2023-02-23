<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Jobs\CreateUserJob;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create(){
        $fonctions = User::FONCTION;
        return view('admin.users.create', compact('fonctions'));
    }

    public function users()
    {
        $users = User::where('canconnect', false)->get();
        $fonctions = User::FONCTION;
        $labelusers = [];
        foreach($users as $user){
            $labelusers[] = ['label' => $user->username, 'value'=> $user->id];
        }
        return view('admin.users.index', compact('users', 'fonctions', 'labelusers'));
    }

    public function store(CreateUserRequest $request){
        $this->dispatchSync(CreateUserJob::fromRequest($request));

        return redirect()->route('users');
    }
}
