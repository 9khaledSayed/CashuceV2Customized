<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_violation', function (Blueprint $table) {
            $table->id();
            $table->unique(['violation_id', 'employee_id', 'date']);
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('violation_id');
            $table->unsignedBigInteger('company_id');
            $table->integer('repeats');
            $table->string('deduction');
            $table->decimal('addition_to')->default(0);
            $table->date('date');
            $table->integer('minutes_late')->nullable();
            $table->integer('absence_days')->nullable();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');

            $table->foreign('violation_id')
                ->references('id')
                ->on('violations')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_violations');
    }
}
