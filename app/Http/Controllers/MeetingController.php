<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    //

    public function list(){
        $meetings = Meeting::all();
        return view('admin.meetings.list', compact('meetings'));
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
        return view('admin.meetings.show', compact('meeting'));
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
}
