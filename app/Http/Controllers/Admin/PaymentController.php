<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\CreatePaymentJob;
use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    //
    public function show(User $user){
        $payments = Payment::where('user_id', $user->id)->where('status', Payment::ACTIF_STATUS)->get();
        return view('admin.payments.show', compact('user', 'payments'));
    }

    public function create(User $user){
        return view('admin.payments.create', compact('user'));
    }

    public function store(User $user, Request $request){
        $this->dispatchSync(CreatePaymentJob::fromRequest($user, $request));
        
        return redirect()->route('payments', $user);
    }

    
}
