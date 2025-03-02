<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRISTables extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('ck_settings_id')->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->char('gender', 1);
            $table->text('address');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('salaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->integer('type');
            $table->float('rate');
            $table->date('effective_date');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('letter_formats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->text('content');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('letter_format_id');
            $table->uuid('user_id');
            $table->string('name', 100);
            $table->timestamps();
            
            $table->foreign('letter_format_id')->references('id')->on('letter_formats')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('check_clock_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 50);
            $table->integer('type');
            $table->timestamps();
        });

        Schema::create('check_clock_setting_times', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ck_settings_id');
            $table->date('day');
            $table->time('clock_in');
            $table->time('clock_out');
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();
            $table->timestamps();
            
            $table->foreign('ck_settings_id')->references('id')->on('check_clock_settings')->onDelete('cascade');
        });

        Schema::create('check_clocks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->integer('check_clock_type');
            $table->time('check_clock_time');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('check_clocks');
        Schema::dropIfExists('check_clock_setting_times');
        Schema::dropIfExists('check_clock_settings');
        Schema::dropIfExists('letters');
        Schema::dropIfExists('letter_formats');
        Schema::dropIfExists('salaries');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('users');
    }
}
