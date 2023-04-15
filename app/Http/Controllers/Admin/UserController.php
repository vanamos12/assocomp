<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Utils\Utils;
use App\Models\Rubrique;
use App\Jobs\CreateUserJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;

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
        $company_id = auth()->user()->company_id;
        $users = Utils::getUsersFromCompany($company_id);
        $fonctions = User::FONCTION;
        $labelusers = [];
        foreach($users as $user){
            $labelusers[] = ['label' => $user->username, 'value'=> $user->id];
            $user->balanceCotisation = Utils::balanceUser($company_id, Rubrique::COTISATION, $user->id);
            $user->balanceEpargne = Utils::balanceUser($company_id, Rubrique::EPARGNE, $user->id);
            $user->balanceFondsRoulement = Utils::balanceUser($company_id, Rubrique::FONDS_ROULEMENT, $user->id);
        }
        return view('admin.users.index', compact('users', 'fonctions', 'labelusers'));
    }

    public function store(CreateUserRequest $request){
        $this->dispatchSync(CreateUserJob::fromRequest($request));

        return redirect()->route('users');
    }

    public function show(User $user){
        $loanedtotaluser = Utils::getUserLoan($user->id, $user->company_id);
        $loanedUserRemboursable = Utils::getUserLoanRemboursable($user->id, $user->company_id);
    }
}
