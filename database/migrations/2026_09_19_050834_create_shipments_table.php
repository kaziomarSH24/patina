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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('escrow_transaction_id')->constrained()->cascadeOnDelete();
            $table->string('carrier')->default('BlueDart');
            $table->string('awb_number')->nullable()->unique();
            $table->string('status')->default('pending')->comment('pending, ready_for_pickup, picked_up, in_transit, delivered, returned, cancelled');
            $table->string('label_url')->nullable();
            $table->string('pickup_token')->nullable();
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->text('tracking_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
