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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->string('brand');
            $table->string('model');
            $table->string('reference_number')->nullable();
            $table->decimal('price', 12, 2);
            $table->enum('status', ['Under Review', 'Live', 'Sold', 'Rejected'])->default('Under Review');
            $table->boolean('is_verified')->default(false);
            $table->text('condition_notes')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
