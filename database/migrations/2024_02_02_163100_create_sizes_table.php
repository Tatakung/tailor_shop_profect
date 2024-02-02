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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('dress_id'); // เพิ่ม dress_id 
            $table->string('size_name')->nullable();
            $table->decimal('price', 9, 2)->nullable();
            $table->decimal('deposit', 9, 2)->nullable();
            $table->integer('amount')->nullable();
            
            $table->timestamps();
            $table->softDeletes(); 

            // กำหนด Foreign Key ให้ dress_id อ้างอิงไปยังตาราง dresses
            $table->foreign('dress_id')->references('id')->on('dresses')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
