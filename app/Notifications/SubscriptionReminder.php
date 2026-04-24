<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SubscriptionReminder extends Notification
{
    use Queueable;

    public $subscription;

    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    public function via($notifiable)
    {
        return ['database']; // or mail
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your subscription will be delivered tomorrow.',
            'product' => $this->subscription->product->name,
            'date' => $this->subscription->next_delivery_date,
        ];
    }
}
