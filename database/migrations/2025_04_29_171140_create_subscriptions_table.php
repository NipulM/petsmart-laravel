<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Fifth Migration - Subscriptions Table
class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('subscription_id');
            $table->string('plan_type', 50);
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->json('features');
        });
        
        // Insert initial subscription plans
        DB::table('subscriptions')->insert([
            [
                'subscription_id' => 1, 
                'plan_type' => 'Basic', 
                'description' => 'Enjoy hassle-free pet care with a 3-month subscription. Customize your supplies and receive regular deliveries to your door.',
                'price' => 29.99,
                'features' => json_encode(["Flexible supply updates anytime", "Monthly toy replacement to keep your pet entertained"])
            ],
            [
                'subscription_id' => 2, 
                'plan_type' => 'Premium', 
                'description' => 'Simplify your pet care for an entire year with our Premium Plan. Fully managed supplies and monthly surprises!',
                'price' => 49.99,
                'features' => json_encode(["All benefits of the Basic Plan", "Exclusive premium items included"])
            ]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}