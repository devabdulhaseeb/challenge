<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id'); 
            $table->unsignedBigInteger('employee_id'); 
            $table->string('people_name')->nullable(); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('manager_id')->references('id')->on('managers');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('people');
    }
};
