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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->text('user_name');
            $table->text('prefix_name');
            $table->text('first_name');
            $table->text('middle_name');
            $table->text('last_name');
            $table->text('gender');
            $table->text('email');
            $table->date('date_of_birth');
            $table->time('time_of_birth',$precision = 0);
            $table->double('age_in_yrs')->nullable();
            $table->double('age_in_company')->nullable();
            $table->date('date_of_join');
            $table->text('phone');
            $table->text('place');
            $table->text('country');
            $table->text('city');
            $table->text('zip')->nullable();
            $table->text('region');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
