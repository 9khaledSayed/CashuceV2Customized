<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('id');

            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unique(['manager_id', 'job_number']);
            $table->string('name_in_arabic');
            $table->string('name_in_english');
            $table->string('job_number');
            $table->integer('vacations_balance');
            $table->string('barcode');
            $table->string('email')->unique();
            $table->boolean('is_manager')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->decimal('salary')->default(0);
            $table->string('password');
            $table->rememberToken();

            $table->foreign('manager_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
            $table->foreign('supervisor_id')
                ->references('id')
                ->on('employees')
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
        Schema::dropIfExists('employees');
    }
}
