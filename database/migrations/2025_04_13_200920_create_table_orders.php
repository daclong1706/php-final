<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('vnpay_order_id'); // Mã đơn hàng (vnp_TxnRef)
            $table->decimal('amount', 10, 2); // Số tiền
            $table->string('order_info'); // Nội dung
            $table->string('transaction_no'); // Mã giao dịch VNPAY
            $table->string('bank_code'); // Mã ngân hàng
            $table->string('payment_time'); // Thời gian thanh toán
            $table->tinyInteger('status')->default(0); // 0: pending, 1: success, 2: failed
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
