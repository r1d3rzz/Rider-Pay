<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->guard("web")->user();
        $notifications = $user->notifications()->latest()->paginate(10);
        return view("frontend.notifications.index", compact(["notifications"]));
    }

    public function show($id)
    {
        $user = auth()->guard("web")->user();
        $notification = $user->notifications()->where("id", $id)->firstOrFail();
        if ($notification) {
            $notification->markAsRead();
            $notification->update();
        }
        return view("frontend.notifications.show", compact(["notification"]));
    }
}
