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
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->string('accessory_name')->nullable(); 
            // $table->string('accessory_code')->nullable(); 
            $table->integer('accessory_count')->nullable(); 
            $table->decimal('accessory_price', 10, 2)->nullable(); 
            $table->string('accessory_image')->nullable();
            $table->text('accessory_description')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessories');
    }
};
