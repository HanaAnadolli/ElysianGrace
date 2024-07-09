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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('check_in_info')->nullable();
            $table->text('check_out_info')->nullable();
            $table->text('house_rules')->nullable();
            $table->text('children_extra_beds_info')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 8, 2); // Added price field
            $table->date('selected_in_date')->nullable();
            $table->date('selected_out_date')->nullable();
            $table->integer('adults')->default(0);
            $table->integer('children')->default(0);
            $table->integer('number_of_rooms')->default(1);
            $table->json('amenities')->nullable();
            $table->string('status')->default('available'); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
