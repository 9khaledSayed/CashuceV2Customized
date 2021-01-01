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
            $table->string('fname_ar');
            $table->string('mname_ar')->nullable();
            $table->string('lname_ar');
            $table->string('fname_en');
            $table->string('mname_en')->nullable();
            $table->string('lname_en');
            $table->string('job_number');
            $table->date('birthdate');
            $table->unsignedBigInteger('nationality_id');
            $table->integer('marital_status')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('identity_type')->nullable();
            $table->string('id_num');
            $table->date('id_issue_date')->nullable();
            $table->date('id_expire_date')->nullable();
            $table->string('passport_num')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expire_date')->nullable();
            $table->string('issue_place')->nullable();
            $table->date('joined_date');
            $table->string('work_shift')->nullable();
            $table->string('contract_type');
            $table->date('contract_start_date');
            $table->integer('contract_period')->nullable();
            $table->string('allowance', 1000)->nullable();
            $table->string('phone');
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