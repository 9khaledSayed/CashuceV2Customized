<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unique(['employee_id', 'date']);
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('company_id');
            $table->time('time_in');
            $table->time('time_out')->nullable();
            $table->time('time_in2')->nullable();
            $table->time('time_out2')->nullable();
            $table->time('total_working_hours')->nullable();
            $table->date('date');
            $table->boolean('day_off')->default(false);
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
