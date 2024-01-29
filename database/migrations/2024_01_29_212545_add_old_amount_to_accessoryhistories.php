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
        Schema::table('accessoryhistories', function (Blueprint $table) {
            //
            $table->decimal('old_amount', 8, 2)->nullable(); // เพิ่มคอลัมน์นี้
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accessoryhistories', function (Blueprint $table) {
            //
            $table->dropColumn('old_amount'); //ยกเลิกการเพิ่มคอลัมน์
        });
    }
};
