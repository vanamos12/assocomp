<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Jobs\CreateUserJob;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create(){
        $fonctions = User::FONCTION;
        $users = Utils::getUsersFromCompany(auth()->user()->company_id);
        $labelusers = [];
        foreach($users as $user){
            $labelusers[] = ['label' => $user->username, 'value'=> $user->id];
        }
        return view('admin.users.create', compact('fonctions', 'labelusers'));
    }

    public function users()
    {
        $users = Utils::getUsersFromCompany(auth()->user()->company_id);
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
