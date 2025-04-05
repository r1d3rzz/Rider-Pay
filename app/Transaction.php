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

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function source()
    {
        return $this->belongsTo(User::class, "source_id", "id");
    }
}
