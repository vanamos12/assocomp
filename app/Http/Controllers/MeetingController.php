<?php

namespace App\Http\Controllers;

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

    public function showMeeting(){
        return view('');
    }
}
