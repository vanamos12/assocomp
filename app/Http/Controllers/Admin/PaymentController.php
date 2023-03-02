<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\CreatePaymentJob;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Utils\Utils;

class PaymentController extends Controller
{
    //
    public function show(User $user){
        $payments = Payment::where('user_id', $user->id)->where('status', Payment::ACTIF_STATUS)->get();
        foreach($payments as $payment){
            $nextPaymentLimit = Carbon::createFromFormat('Y-m-d', $payment->nextpaymentlimit);
            $amount = $payment->amount;
            $tab = Utils::calculatePayment($nextPaymentLimit, $amount);
            if ($tab['modified']){
                $payment->update([
                    'nextpaymentlimit' => $tab['nextPaymentLimit'],
                    'total' => $payment->total + $tab['totalInterest']
                ]);
            }
        }
        $sum = Payment::where('user_id', $user->id)->where('status', Payment::ACTIF_STATUS)->sum('total');
        return view('admin.payments.show', compact('user', 'payments', 'sum'));
    }

    public function create(User $user){
        return view('admin.payments.create', compact('user'));
    }

    public function store(User $user, Request $request){
        $this->dispatchSync(CreatePaymentJob::fromRequest($user, $request));
        
        return redirect()->route('payments', $user);
    }

    public function giveback(User $user, Payment $payment){
        $payment->update([
            'status' => Payment::REMBOURSE_STATUS,
        ]);

        return redirect()->route('payments', $user);
    }
    
}
