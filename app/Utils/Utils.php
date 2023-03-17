<?php
namespace App\Utils;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Rubrique;
use Illuminate\Support\Facades\Date;

class Utils {

    public static function getActiveRubriques($company_id){
        $dateNow = date('Y-m-d');
        return Rubrique::where('debut', '<=', $dateNow)
                    ->where('fin', '>=', $dateNow)
                    ->where('company_id', $company_id)
                    ->get();
    }

    public static function getLoanTotal($company_id){
        $loans = Loan::where('loaned', '!=' , Loan::LOANED)
                        ->where('company_id', $company_id)
                        ->get();
        $loantotal = Utils::loanTotal($loans);
        return $loantotal;
    }

    public static function getMeetingsFromCompany($company_id){
        $meetings = Meeting::where('company_id', $company_id)->get();
        return $meetings;
    }

    public static function getUsersFromCompany($company_id){
        $users = User::where('canconnect', false)
                        ->where('company_id', $company_id)
                        ->get();

        return $users;
    }

    public static function loanTotal($loans){
        $sum = 0;
        foreach($loans as $loan){
            if ($loan->loaned == Loan::NOT_LOANED){
                $sum += $loan->amount;
            }else if ($loan->loaned == Loan::PARTIAL_LOANED){
                $sum += $loan->partloanamount;
            }
        }
        return $sum;
    }

    public static function borrowMoney($amount){
        $loans = Loan::where('loaned', '!=' , Loan::LOANED)->get();
        $count = count($loans);
        $i = 0;
        $continue = true;
        while($i < $count && $continue){
            $loan = $loans->get($i);
            $amountunitloan = 0;
            if($loan->loaned == Loan::NOT_LOANED){
                $amountunitloan = $loan->amount;
            }else if ($loan->loaned == Loan::PARTIAL_LOANED){
                $amountunitloan = $loan->partloanamount;
            }
            $rest = $amountunitloan - $amount;
            if ($rest == 0){
                $loan->update([
                    "loaned" => Loan::LOANED,
                    "partloanamount" => 0
                ]);
                $continue = false;
            }else if ($rest > 0){
                
                $loan->update([
                    "loaned" => Loan::PARTIAL_LOANED,
                    "partloanamount" => $rest,
                ]);
                $continue = false;
                // put values in textloaned

            }else {  // $rest < 0
                $loan->update([
                    "loaned" => Loan::LOANED,
                    "partloanamount" => 0
                ]);
                $amount = -$rest;
            }

            $i++;
        }
    }

    public static function roundToUpper($number){
        if (self::isInt($number)){
            return $number + 1;
        }else{
            return ceil($number);
        }
    }

    public static function isInt($numberFloat){
        $numberInt = (int)$numberFloat;
        if ($numberFloat - $numberInt > 0){
            return false;
        }
        return true;
    }


    public static function calculatePayment(
        Carbon $nextPaymentLimit ,
        int $amount, 
    ){
        
        $dateCreation = clone $nextPaymentLimit;
        $dateNow = Carbon::now();
        $nextPaymentLimitFor = Carbon::now();
        $modified = false;
        $totalInterest = 0;
        if ($dateCreation <= $dateNow){
            $modified = true;
            $months = $dateCreation->diffInMonths($dateNow);
            $period = config('association.period', 3);
            
            $periods = self::roundToUpper($months / $period);
            $interest = config('association.interest', 10) / 100;
            $totalInterest = $periods * $interest * $amount; 
            $nextPaymentLimitFor = $dateCreation->addMonths((int)($periods*$period));
        }

        return [
            'totalInterest' => $totalInterest,
            'nextPaymentLimit' => $nextPaymentLimitFor,
            'modified' => $modified,
        ];
    }

}