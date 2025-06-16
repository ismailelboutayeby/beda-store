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
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->string('status');
            $table->unsignedBigInteger('assigned_designer_id')->nullable();
            $table->unsignedBigInteger('assigned_warehouse_id')->nullable();
            $table->unsignedBigInteger('assigned_production_id')->nullable();
            $table->unsignedBigInteger('assigned_logistics_id')->nullable();
            $table->unsignedBigInteger('assigned_quality_id')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('assigned_designer_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_warehouse_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_production_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_logistics_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_quality_id')->references('id')->on('users')->onDelete('set null');
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
