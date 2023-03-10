<?php

use App\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AddPaymentMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        PaymentMethod::whereIn('config_key', ['paypal', 'fondy'])->delete();
        
        $paymentMethod = new PaymentMethod();
        $paymentMethod->class_name = 'App\\Services\\Payment\\PaypalPayment';
        $paymentMethod->label = 'PayPal';
        $paymentMethod->config_key = 'paypal';
        $paymentMethod->priority = 1;
        $paymentMethod->enabled = true;
        $paymentMethod->save();
    
        $paymentMethod = new PaymentMethod();
        $paymentMethod->class_name = 'App\\Services\\Payment\\FondyPayment';
        $paymentMethod->label = 'Fondy';
        $paymentMethod->config_key = 'fondy';
        $paymentMethod->priority = 2;
        $paymentMethod->enabled = true;
        $paymentMethod->save();
    }
    
    /**O
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::table('payment_methods')->truncate();
    }
}
