<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // Status 
        // 0 : đang chờ
        // 1 : đã duyệt
        // 2 : đang xử lí
        // 3 : hoàn thiện
        // 4 : đã giao hàng
        // 5 : đã hủy
        // 6 : yêu cầu hủy
        
        // payment_status
        // 0 : chưa thanh toán
        // 1 : đã thanh toán online
        // 2 : đã thanh toán offline

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('services_name');
            $table->string('services_prices');
            $table->integer('printed_start')->nullable();
            $table->integer('printed_end')->nullable();
            $table->string('url');
            $table->string('note');
            $table->string('total_prices');
            $table->integer('status'); 
            $table->integer('payment_status'); 
            $table->integer('copy'); 
            $table->integer('slide'); 
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
