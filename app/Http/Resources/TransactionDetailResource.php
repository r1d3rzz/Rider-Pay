<?php

namespace App\Http\Resources;

use App\Helpers\MakeSecretValue;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $phone = MakeSecretValue::coverPhoneNumber($this->source->phone);
        return [
            "title" => "လုပ်ဆောင်မှု့‌အောင်မြင်ပါသည်။",
            "amount" => $this->amount,
            "created_at" => Carbon::parse($this->created_at)->format("Y-m-d H:i:s"),
            "txn_id" => $this->txn_id,
            "ref_no" => $this->ref_no,
            "type" => $this->type == 1 ? "ငွေလက်ခံ" : "‌ငွေလွဲ",
            "sender" => $this->source->name . " (" . $phone . ")",
            "amount" => $this->amount,
            "description" => $this->description,
        ];
    }
}
