<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rubrique;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    //

    public function rubriqueList(){
        $dateNow = date('Y-m-d');
        $rubriques = Rubrique::where('debut', '<=', $dateNow)
                                ->where ('fin', '>=', $dateNow)->get();
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
        ]);

        $rubrique->save();

        return redirect()->route('rubriques');
    }
}
