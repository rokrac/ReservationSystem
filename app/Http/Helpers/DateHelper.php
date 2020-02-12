<?php

namespace App\Helpers;

class DateHelper
{
    public static function startDate($startDate)
    {
        return new \DateTime($startDate);
    }
    public static function endDate($endDate,$time)
    {
        $end_date = new \DateTime($endDate);
        return $end_date->modify('+'. $time . 'hour');
    }
}