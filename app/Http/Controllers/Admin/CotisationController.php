<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rubrique;
use App\Utils\Utils;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    //

    public function rubriqueList(){
        $dateNow = date('Y-m-d');
        $rubriques = Utils::getActiveRubriques(auth()->user()->company_id);
        return view('admin.rubriques.list', compact('rubriques'));
    }

    public function rubriqueCreate(){
        return view('admin.rubriques.create');
    }

    public function rubriqueStore(Request $request){
        $rubrique = new Rubrique([
            'name' => $request->get('name'),
            'debut' => $request->get('debut'),
            'fin' => $request->get('fin'),
            'company_id' => auth()->user()->company_id
        ]);

        $rubrique->save();

        return redirect()->route('rubriques');
    }
}
