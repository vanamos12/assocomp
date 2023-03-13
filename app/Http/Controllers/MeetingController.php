<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Utils\Utils;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Jobs\CreatePaymentJob;
use App\Models\Payment;

class MeetingController extends Controller
{
    //

    public function list(){
        $loans = Loan::where('loaned', '!=' , Loan::LOANED)->get();
        $loantotal = Utils::loanTotal($loans);
        $meetings = Meeting::all();
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
            'creation' => $creation
        ]);
        $meeting->save();
        return redirect()->route('meetings');

    }

    public function show(Meeting $meeting){
        $loans = Loan::where('loaned', '!=' , Loan::LOANED)->get();
        $loantotal = Utils::loanTotal($loans);

        $loansmeeting = Loan::where('meeting_id', $meeting->id)->get();
        $paymentsmeeting = Payment::where('meeting_id', $meeting->id)->get();
        return view('admin.meetings.show', compact('meeting', 'loantotal', 'loansmeeting', 'paymentsmeeting'));
    }

    public function loanCreate(Meeting $meeting){
        $users = User::where('canconnect', false)->get();
        $labelusers = [];
        foreach($users as $user){
            $labelusers[] = ['label' => $user->username, 'value'=> $user->id];
        }
        return view('admin.meetings.loan', compact('meeting', 'labelusers'));
    }

    public function loanStore(Meeting $meeting, Request $request){
        $validated = $request->validate([
            'amount' => 'required|numeric|gt:0',
            'user_id' => 'required',
            'creation' => 'required'
        ]);

        $loan = new Loan([
            'user_id' => $request->get('user_id'),
            'amount' => $request->get('amount'),
            'creation' => $request->get('creation'),
            'meeting_id' => $meeting->id,
        ]);

        $loan->save();

        return redirect()->route('meetings.show', $meeting->id);
    }

    public function borrowCreate(Meeting $meeting){
        $users = User::where('canconnect', false)->get();
        $labelusers = [];
        foreach($users as $user){
            $labelusers[] = ['label' => $user->username, 'value'=> $user->id];
        }
        return view('admin.meetings.borrow', compact('meeting', 'labelusers'));
    }

    public function borrowStore(Meeting $meeting, Request $request){
        $loans = Loan::where('loaned', '!=' , Loan::LOANED)->get();
        $loantotal = Utils::loanTotal($loans);
        $validated = $request->validate([
            'amount' => 'required|numeric|gt:0|lte:'.$loantotal,
            'user_id' => 'required',
            'creation' => 'required'
        ]);

        $amount = $request->get('amount');
        Utils::borrowMoney($amount, $loans, $loantotal);

        $user = User::where('id', $request->get('user_id'))->first();
        $this->dispatchSync(CreatePaymentJob::fromRequest($user, $meeting, $request));

        

        return redirect()->route('meetings.show', $meeting->id);
    }
}