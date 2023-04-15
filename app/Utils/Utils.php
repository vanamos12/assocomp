<?php
namespace App\Utils;

use App\Models\Company;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Payment;
use App\Models\Rubrique;
use Illuminate\Support\Facades\Date;

class Utils {
    public static function balanceUser($company_id, $rubrique_id, $user_id){
        $cotisetotal = Loan::where('loaned', '!=' , Loan::LOANED)
        ->where('company_id', $company_id)
        ->where('rubrique_id', $rubrique_id)
        ->where('user_id', $user_id)
        ->sum('amount');
        $empruntetotal = Payment::where('status', Payment::ACTIF_STATUS)
                        ->where('company_id', $company_id)
                        ->where('rubrique_id', $rubrique_id)
                        ->where('user_id', $user_id)
                        ->sum('amount');
        return $cotisetotal - $empruntetotal;
    }

    public static function balance($company_id, $rubrique_id){
        $cotisetotal = Loan::where('loaned', '!=' , Loan::LOANED)
        ->where('company_id', $company_id)
        ->where('rubrique_id', $rubrique_id)
        ->sum('amount');
        $empruntetotal = Payment::where('status', Payment::ACTIF_STATUS)
                        ->where('company_id', $company_id)
                        ->where('rubrique_id', $rubrique_id)
                        ->sum('amount');
        return $cotisetotal - $empruntetotal;
    }
    public static function getActiveRubriques($company_id){
        $dateNow = date('Y-m-d');
        return Rubrique::where('debut', '<=', $dateNow)
                    ->where('fin', '>=', $dateNow)
                    ->where('company_id', $company_id)
                    ->get();
    }

    public static function getUserLoan($user_id, $company_id){
        $sumTotalLoanUser = Loan::where('user_id', $user_id)
                        ->where('company_id', $company_id)
                        ->sum('amount');
        return $sumTotalLoanUser;
    }
    
    public static function getUserLoanRemboursable($user_id, $company_id){
        $loans = Loan::where('loaned', '!=' , Loan::NOT_LOANED)
                        ->where('company_id', $company_id)
                        ->where('user_id', $user_id)
                        ->get();
        return Utils::loanTotalRemboursable($loans);
    }
    public static function getBalanceUser($user_id){
        $cotisetotal = Loan::where('loaned', '!=' , Loan::LOANED)
        ->where('user_id', $user_id)
        ->sum('amount');
        $empruntetotal = Payment::where('status', Payment::ACTIF_STATUS)
                        ->where('user_id', $user_id)
                        ->sum('amount');
        return $cotisetotal - $empruntetotal;
    }
    public static function getCotiseTotal($company_id, $meeting_id){
        $cotisetotal = Loan::where('loaned', '!=' , Loan::LOANED)
                        ->where('company_id', $company_id)
                        ->where('meeting_id', $meeting_id)
                        ->sum('amount');
        $empruntetotal = Payment::where('status', Payment::ACTIF_STATUS)
        ->where('company_id', $company_id)
        ->where('meeting_id', $meeting_id)
        ->sum('amount');
        return $cotisetotal-$empruntetotal;
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
    public static function loanTotalRemboursable($loans){
        $sum = 0;
        foreach($loans as $loan){
            if ($loan->loaned == Loan::NOT_LOANED){
                $sum += $loan->amount;
            }else if ($loan->loaned == Loan::PARTIAL_LOANED){
                $sum += $loan->amount - $loan->partloanamount;
            }
        }
        return $sum;
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
            $period = Utils::getPeriod();
            
            $periods = self::roundToUpper($months / $period);
            $interest = Utils::getInterest() / 100;
            $totalInterest = $periods * $interest * $amount; 
            $nextPaymentLimitFor = $dateCreation->addMonths((int)($periods*$period));
        }

        return [
            'totalInterest' => $totalInterest,
            'nextPaymentLimit' => $nextPaymentLimitFor,
            'modified' => $modified,
        ];
    }

    public static function getInterest(){
        return Company::where('id', auth()->user()->company_id)->first()->interest;
    }

    public static function getPeriod(){
        return Company::where('id', auth()->user()->company_id)->first()->period;
    }

    

}