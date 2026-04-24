<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Models\Order;
use Carbon\Carbon;
use App\Notifications\SubscriptionReminder;

class ProcessSubscriptions extends Command
{
    protected $signature = 'subscriptions:process';
    protected $description = 'Create orders from subscriptions';

    public function handle()
    {
        $today = Carbon::today();

        $subscriptions = Subscription::with(['user', 'product'])
            ->whereDate('next_delivery_date', '<=', $today)
            ->get();

        foreach ($subscriptions as $sub) {

            // ✅ CREATE ORDER
            Order::create([
                'user_id' => $sub->user_id,
                'total_price' => $sub->product->price,
                'status' => 'pending'
            ]);

            $tomorrow = Carbon::tomorrow();

            $reminders = Subscription::with('user', 'product')
                ->whereDate('next_delivery_date', $tomorrow)
                ->get();

            foreach ($reminders as $sub) {
                $sub->user->notify(new SubscriptionReminder($sub));
            }

            // ✅ UPDATE NEXT DELIVERY DATE
            if ($sub->frequency === 'daily') {
                $sub->next_delivery_date = $today->addDay();
            } elseif ($sub->frequency === 'weekly') {
                $sub->next_delivery_date = $today->addWeek();
            } else {
                $sub->next_delivery_date = $today->addMonth();
            }

            $sub->save();
        }

        $this->info('Subscriptions processed successfully.');
    }
}
