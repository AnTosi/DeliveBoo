<?php

use App\Models\Order;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $order = new Order();
            $order->customer_name = $faker->name();
            $order->address = $faker->address();
            $order->email = $faker->email();
            $order->data = $faker->dateTime();
            $order->dish_price = $faker->randomFloat(2,3,200);
            $order->total_price = $faker->randomFloat(2,3,200);
            $order->save();
        }
    }
}
