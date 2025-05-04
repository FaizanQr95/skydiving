<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_awardeds', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->unsignedBigInteger('user_id')->nullable(); // user this coupon is assigned to
            $table->integer('points');
            $table->float('discount'); // percentage
            $table->float('coupon_value'); // actual discount value (points * %)
            $table->string('square_discount_id')->nullable(); // from Square API
            $table->enum('status', ['active', 'used', 'expired'])->default('active');
            $table->timestamp('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_awardeds');
    }
};
