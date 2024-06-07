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
            $table->foreignId('state_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('zip_code_id')->constrained()->onDelete('cascade');
            $table->string('adress');
            $table->string('phone_number');
            $table->decimal('total', 12, 2);
            $table->integer('total_products');
            $table->enum('status', ['IN PREPARATION', 'ON THE WAY', 'DELIVERED', 'CANCELED', 'DELAYED', 'LOST']);
            $table->timestamps();
            $table->softDeletes();
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
