<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('work_days');
            $table->time('shift_start_time');
            $table->time('shift_end_time');
            $table->time('overtime_hours');
            $table->boolean('is_delay_allowed')->default(false);
            $table->boolean('is_default')->default(false);
            $table->time('time_delay_allowed')->default('00:00:00');
            $table->enum('type', ['normal', 'divided', 'flexible', 'once']);
            $table->timestamps();

            $table->unique(['manager_id', 'name_ar']);
            $table->unique(['manager_id', 'name_en']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_shifts');
    }
}
