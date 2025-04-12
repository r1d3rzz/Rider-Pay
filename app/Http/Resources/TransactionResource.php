<?php

namespace App\Http\Resources;

use App\Helpers\MakeSecretValue;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    /*
     <div>
        <div class="padauk-regular"> {{$transaction->type == 1 ? "ပေးပို့သူ" : "ငွေလွှဲမည် သို့
            "}} <span class="sourcePhone">{{
                App\Helpers\MakeSecretValue::coverPhoneNumber($transaction->source->phone) }}</span>
        </div>
        <div class="poppins-regular"><small>{{$transaction->created_at}}</small></div>
    </div>
    <div class="">
        <small
            class="poppins-regular font-weight-bold {{ $transaction->type == 1 ? 'text-success' : 'text-danger' }}">
            {{$transaction->type == 1 ? "+" : "-"}}
            {{ number_format($transaction->amount) }} MMK
        </small>
    </div>
     */
    public function toArray($request)
    {
        $type = $this->type == 1 ? "ပေးပို့သူ " : "ငွေလွှဲမည် သို့ ";
        $phone = MakeSecretValue::coverPhoneNumber($this->user->phone);
        return [
            "title" => $type . $phone,
            "amount" => number_format(1000, 2),
            "created_at" => Carbon::parse($this->created_at)->format("Y-m-d H:i:s"),
        ];
    }
}
