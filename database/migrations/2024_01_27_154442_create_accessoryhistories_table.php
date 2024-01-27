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
        Schema::create('accessoryhistories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accessory_id'); //เพิ่ม accessory_id
            $table->string('action')->nullable();
            $table->decimal('new_amount', 8, 2)->nullable(); 
            $table->timestamps();
            $table->softDeletes();

            //กำหนด Foreign Key ให้ accessory_id อ้างอิงไปยังตาราง accessories
            $table->foreign('accessory_id')->references('id')->on('accessories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessoryhistories');
    }
};
