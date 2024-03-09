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
        Schema::table('orderdetails', function (Blueprint $table) {
            //
            $table->date('pickup_date')->nullable(); 
            $table->date('return_date')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            //
            $table->dropColumn('pickup_date');
            $table->dropColumn('return_date');
        });
    }
};
