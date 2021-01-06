<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->decimal('value')->nullable();
            $table->decimal('percentage')->nullable();
            $table->integer('type');
            $table->boolean('is_basic')->default(false);
            $table->string('label')->nullable();
            $table->timestamps();

            $table->unique(['manager_id', 'name_ar', 'name_en']);
        });

        Schema::create('allowance_employee', function (Blueprint $table) {
            $table->primary(['allowance_id', 'employee_id']);
            $table->unsignedBigInteger('allowance_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            $table->foreign('allowance_id')
                ->references('id')
                ->on('allowances')
                ->onDelete('cascade');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allowances');
    }
}
