<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Utils\Utils;
use App\Models\Meeting;
use App\Models\Payment;
use App\Models\Rubrique;
use Illuminate\Http\Request;
use App\Jobs\CreatePaymentJob;
use App\Models\Cotisation;

class MeetingController extends Controller
{
    //

    public function list(){
        $company_id = auth()->user()->company_id;
        $loantotal = Utils::getLoanTotal($company_id);
        $meetings = Utils::getMeetingsFromCompany($company_id);
        return view('admin.meetings.list', compact('meetings', 'loantotal'));
    }

    public function create(){
        return view('admin.meetings.create');
    }

    public function store(Request $request){
        $name = $request->get('name');
        $creation = $request->get('creation');

        $meeting = new Meeting([
            'name' => $name,
            'creation' => $creation,
            'company_id' => auth()->user()->company_id
        ]);
        $meeting->save();
        return redirect()->route('meetings');

    }

    public function show(Meeting $meeting){
        $company_id = auth()->user()->company_id;

        $balanceCotisation = Utils::balance($company_id, Rubrique::COTISATION);
        $balanceEpargne = Utils::balance($company_id, Rubrique::EPARGNE);
        $balanceFondsRoulement = Utils::balance($company_id, Rubrique::FONDS_ROULEMENT);

        $loansmeeting = Loan::where('meeting_id', $meeting->id)
                                ->where('company_id', $company_id)
                                ->get();
        $paymentsmeeting = Payment::where('meeting_id', $meeting->id)
                                    ->where('company_id', $company_id)
                                    ->get();
        $cotisationsmeeting = Cotisation::where('meeting_id', $meeting->id)
                                    ->where('company_id', $company_id)
                                    ->get();
        return view('admin.meetings.show', compact('meeting', 'loansmeeting', 'paymentsmeeting', 'cotisationsmeeting', 'balanceCotisation', 'balanceEpargne', 'balanceFondsRoulement'));
    }

    public function loanCreate(Meeting $meeting){
        $users = Utils::getUsersFromCompany(auth()->user()->company_id);
        $labelusers = [];
        foreach($users as $user){
            $labelusers[] = ['label' => $user->username, 'value'=> $user->id];
        }
        $rubriques = Rubrique::where('company_id', auth()->user()->company_id)->get();
        return view('admin.meetings.loan', compact('meeting', 'labelusers', 'rubriques'));
    }

    public function loanStore(Meeting $meeting, Request $request){
        $validated = $request->validate([
            'amount' => 'required|numeric|gt:0',
            'user_id' => 'required',
            'creation' => 'required',
            'rubrique' => 'required'
        ]);
        
        $loan = new Loan([
            'user_id' => $request->get('user_id'),
            'amount' => $request->get('amount'),
            'creation' => $request->get('creation'),
            'meeting_id' => $meeting->id,
            'company_id' => auth()->user()->company_id,
            'rubrique_id' => $request->get('rubrique'),
        ]);

        $loan->save();

        return redirect()->route('meetings.show', $meeting->id);
    }

    public function borrowCreate(Meeting $meeting){
        $users = Utils::getUsersFromCompany(auth()->user()->company_id);
        $labelusers = [];
        foreach($users as $user){
            $labelusers[] = ['label' => $user->username, 'value'=> $user->id];
        }
        $rubriques = Rubrique::where('company_id', auth()->user()->company_id)->get();
        return view('admin.meetings.borrow', compact('meeting', 'labelusers', 'rubriques'));
    }

    public function borrowStore(Meeting $meeting, Request $request){
        $cotisetotal = Utils::getCotiseTotal(auth()->user()->company_id, $meeting->id);
        $validated = $request->validate([
            'amount' => 'required|numeric|gt:0|lte:'.$cotisetotal,
            'user_id' => 'required',
            'creation' => 'required',
            'rubrique' => 'required'
        ]);

        //$amount = $request->get('amount');
        //Utils::borrowMoney($amount);

        $user = User::where('id', $request->get('user_id'))->first();
        $this->dispatchSync(CreatePaymentJob::fromRequest($user, $meeting, $request));

        

        return redirect()->route('meetings.show', $meeting->id);
    }

    public function cotiserCreate(Meeting $meeting){
        $company_id = auth()->user()->company_id;
        $users = Utils::getUsersFromCompany($company_id);
        $labelusers = [];
        foreach($users as $user){
            $labelusers[] = ['label' => $user->username, 'value'=> $user->id];
        }
        
        $rubriques = Utils::getActiveRubriques($company_id);
        return view('admin.meetings.cotiser', compact('rubriques', 'meeting', 'labelusers'));
    }

    public function cotiserStore(Meeting $meeting, Request $request){
        $cotisation = new Cotisation([
            'user_id' => $request->get('user_id'),
            'rubrique_id' => $request->get('rubrique'),
            'meeting_id' => $meeting->id,
            'amount' => $request->get('amount'),
            'creation' => $request->get('creation'),
            'company_id' => auth()->user()->company_id
        ]);

        $cotisation->save();

        return redirect()->route('meetings.show', $meeting->id);
    }
}
