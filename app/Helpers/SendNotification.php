<?php

namespace App\Helpers;

use App\Notifications\GeneralNotification;
use Illuminate\Support\Facades\Notification;

class SendNotification
{
    public static function send(object $user, string $title, string $message, int $sourceable_id, string $sourceable_type, string $web_link)
    {
        Notification::send([$user], new GeneralNotification(
            $title,
            $message,
            $sourceable_id,
            $sourceable_type,
            $web_link
        ));
    }
}
