<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        for($i=1; $i<=6; $i++){
            $order = Order::create([
                'user_id' => $i+3, // clients IDs: 4..9
                'status' => 'pending',
                'total_price' => 5.50
            ]);

            OrderItem::insert([
                ['order_id' => $order->id, 'product_id' => 1, 'quantity' => 1, 'price' => 2.50],
                ['order_id' => $order->id, 'product_id' => 3, 'quantity' => 1, 'price' => 5.00]
            ]);
        }
    }
}