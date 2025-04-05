<?php

namespace App\Helpers;

class MakeSecretValue
{
    public static function coverPhoneNumber(string $value)
    {
        return str_repeat('*', strlen($value) - 4) . substr($value, -4);
    }
}
