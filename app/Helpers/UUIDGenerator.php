<?php

namespace App\Helpers;

use App\Transaction;
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

    public static function GenerateRefNumber(): int
    {
        $number = mt_rand(100000000, 999999999);

        if (Transaction::where("ref_no", $number)->exists()) {
            self::GenerateRefNumber();
        }

        return $number;
    }


    public static function GenerateTxnNumber(): int
    {
        $number = mt_rand(100000000, 999999999);

        if (Transaction::where("txn_id", $number)->exists()) {
            self::GenerateTxnNumber();
        }

        return $number;
    }
}
