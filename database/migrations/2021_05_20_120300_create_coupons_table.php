<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();
            $table->string('amount')->nullable();
            $table->boolean('is_amount')->default(true);
            $table->string('min_bill_amount');
            $table->string('max_discount');
            $table->boolean('is_onetime')->default(true)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('first_order_only')->default(true)->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
