<?php

namespace App\Helpers;

function success($message, $data = [])
{
    return response()->json([
        "status" => 200,
        "message" => $message,
        "data" => $data
    ]);
}

function fail($message)
{
    return response()->json([
        "status" => 500,
        "message" => $message,
    ]);
}
