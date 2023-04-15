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
        $rubriques = Rubrique::where('company_id', auth()->user()->company_id)->get();
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

    public function rubriqueEdit(Rubrique $rubrique){

        return view('admin.rubriques.edit', compact('rubrique'));
    }

    public function rubriqueEditStore(Rubrique $rubrique, Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'debut' => 'required',
            'fin' => 'required'
        ]);
        $rubrique->update([
            'name' => $request->get('name'),
            'debut' => $request->get('debut'),
            'fin' => $request->get('fin'),
            'company_id' => auth()->user()->company_id
        ]);

        $rubrique->save();

        return redirect()->route('rubriques');
        return view('admin.rubriques.edit', compact('rubrique'));
    }
}
