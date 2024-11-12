<?php

namespace App\Classes;

use DateTime;

class DateTimeHelper
{
    public static function calculateDuration($start,$end){
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $interval = $date1->diff($date2);

        if ($interval->y < 2){
            $year = $interval->y.' Year';
        } else {
            $year = $interval->y.' Years';
        }

        if ($interval->m < 2){
            $month = $interval->m.' Month';
        } else {
            $month = $interval->m.' Months';
        }

        $interval->d = $interval->d+1;
        if ($interval->d < 2){
            $day = $interval->d.' Day';
        } else {
            $day = $interval->d.' Days';
        }

        if($interval->y == 0 && $interval->m == 0){
            $duration = $day;
        } else if($interval->y == 0){
            $duration = $month.', '.$day;
        } else if($interval->m == 0){
            $duration = $year.', '.$day;
        } else {
            $duration = $year.', '.$month.', '.$day;
        }

        return $duration;
    }
}
