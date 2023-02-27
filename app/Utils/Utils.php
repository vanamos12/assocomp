<?php
namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class Utils {

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
        $total = 0;
        if ($dateCreation <= $dateNow){
            $months = $dateCreation->diffInMonths($dateNow);
            $period = config('association.period', 3);
            
            $periods = self::roundToUpper($months / $period);
            $interest = config('association.interest', 10) / 100;
            $totalInterest = $periods * $interest * $amount; 
            $total = $amount + $totalInterest;
            $nextPaymentLimitFor = $dateCreation->addMonths((int)($periods*$period));
            //dd($periods, $interest, $amount);
            //dd($amount,$totalInterest, $total, $nextPaymentlimit);
            
        }

        return [
            'total' => $total,
            'nextPaymentLimit' => $nextPaymentLimitFor,
        ];
    }

}