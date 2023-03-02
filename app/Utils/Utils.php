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