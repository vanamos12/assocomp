<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function __construct(){
        return $this->middleware([IsAdmin::class]);
    }
    //
    public function create(){
        $fonctions = User::FONCTION;
        return view('admin.companies.create', compact('fonctions'));
    }

    public function store(Request $request){
        $company = new Company([
            'name' => $request->get('nameass'),
            'uniquename' => $request->get('nameasssuniq'),
            'rc' => $request->get('rc')
        ]);
        $company->save();

        $user = new User([
            'name' => $request->get('name'),
            'username' =>  $request->get('username'),
            'slug' => Str::slug($request->get('username')),
            'fonction' => $request->get('fonction'),
            'email' => $request->get('email'),
            'bio' => $request->get('bio'),
            'password' => bcrypt('mekowa'),
            'type' => User::MODERATOR,
            'canconnect' => true,
            'company_id' => $company->id
        ]);
        
        $user->save();

        return redirect('/dasboard/success');
    }

}
