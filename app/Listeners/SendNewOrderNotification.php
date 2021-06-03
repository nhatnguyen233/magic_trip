<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewOrderToAdmin;
use Illuminate\Notifications\Notification;

class SendNewOrderNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::where('role_id', true)->get();
        Notification::send($admins, new NewOrderToAdmin($event->user));
    }
}