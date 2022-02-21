<?php

use Illuminate\Database\Seeder;

class PaymentChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PaymentChannel::updateOrCreate(['id' => 1], ['title' => 'paypal', 'class_name' => 'Paypal', 'status' => 'active', 'image' => '/assets/default/img/charge/paypal.png', 'settings' => '', 'created_at' => time()]);
        \App\Models\PaymentChannel::updateOrCreate(['id' => 2], ['title' => 'paystack', 'class_name' => 'Paystack', 'status' => 'active', 'image' => '/assets/default/img/charge/stripe.png', 'settings' => '', 'created_at' => time()]);
        \App\Models\PaymentChannel::updateOrCreate(['id' => 3], ['title' => 'paytm', 'class_name' => 'Paytm', 'status' => 'active', 'image' => '/assets/default/img/charge/paytm.png', 'settings' => '', 'created_at' => time()]);
        \App\Models\PaymentChannel::updateOrCreate(['id' => 4], ['title' => 'payu', 'class_name' => 'Payu', 'status' => 'active', 'image' => '/assets/default/img/charge/paytu.png', 'settings' => '', 'created_at' => time()]);
    }
}
