<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Utils\Utils;
use App\Models\Meeting;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Date;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreatePaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $meeting;
    private $amount;
    private $rubrique;
    private $dateCreation;
    private $nextPaymentLimit;
    private $total;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        User $user,
        Meeting $meeting,
        int $amount,
        string $rubrique,
        Carbon $dateCreation,
        Carbon $nextPaymentLimit,
        $total
    )
    {
        //
        $this->user = $user;
        $this->meeting = $meeting;
        $this->amount = $amount;
        $this->rubrique = $rubrique;
        $this->dateCreation = $dateCreation;
        $this->nextPaymentLimit = $nextPaymentLimit;
        $this->total = $total;
    }

    public static function fromRequest(User $user, Meeting $meeting, Request $request){
        $dateCreation = Carbon::createFromFormat('Y-m-d', $request->get('creation'));
        $amount = (int) $request->get('amount');
        $rubrique =  $request->get('rubrique');
        $tab = Utils::calculatePayment($dateCreation, $amount);
        $nextPaymentLimit = $tab['nextPaymentLimit'];
        $total = $amount + $tab['totalInterest'];

        return new Static(
            $user,
            $meeting,
            $amount,
            $rubrique,
            $dateCreation,
            $nextPaymentLimit,
            $total,
        );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle():Payment
    {
        //
        $payment = new Payment([
            'user_id' => $this->user->id,
            'meeting_id' => $this->meeting->id,
            'amount' => $this->amount,
            'status' => Payment::ACTIF_STATUS,
            'creation' => $this->dateCreation,
            'nextpaymentlimit' => $this->nextPaymentLimit,
            'total' => $this->total,
            'company_id' => auth()->user()->company_id,
            'rubrique_id' => $this->rubrique,
        ]);

        $payment->save();

        return $payment;

    }
}
