<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        for($i=1; $i<=6; $i++){
            Subscription::create([
                'user_id' => $i+3,
                'product_id' => ($i%6)+1,
                'frequency' => 'monthly',
                'next_delivery_date' => Carbon::now()->addMonth()
            ]);
        }
    }
}