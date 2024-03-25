<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helpers extends Model
{
    public static function numberPrecision($number, $decimals = 0)
    {
        $negation = ($number < 0) ? (-1) : 1;
        $coefficient = pow(10, $decimals);
        return $negation * floor((string) (abs($number) * $coefficient)) / $coefficient;
    }
}
