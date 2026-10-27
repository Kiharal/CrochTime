<?php

use App\Models\Cart;
use App\Models\Customer;
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
            $table->foreignIdFor(Cart::class);
            $table->string('location');
            $table->string('payment');
            $table->string('condition');
            $table->integer('subtotal');
            $table->date('due_date');
            $table->integer('priority_days');
            $table->integer('service');
            $table->string('delivery');
            $table->integer('grandtotal');
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();
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
