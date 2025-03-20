<?php

namespace App\Helpers;

use App\Wallet;

class UUIDGenerator
{
    public static function GenerateCardNumber(): int
    {
        $number = mt_rand(1000000000000000, 9999999999999999);

        if (Wallet::where("account_number", $number)->exists()) {
            self::GenerateCardNumber();
        }

        return $number;
    }
}
