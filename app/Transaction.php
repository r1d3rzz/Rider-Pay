<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        "ref_no",
        "txn_id",
        "user_id",
        "source_id",
        "type",
        "amount",
        "description",
    ];
}
