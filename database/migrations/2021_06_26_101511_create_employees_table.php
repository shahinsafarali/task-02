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
            //usually I use increments('id') as primary key instead of id(), because of performance
            // int vs big int - 4 byte vs 8 byte

            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 60);
            $table->date('birth_date');
            $table->string('position', 40);

            //we could use here enum type for payment_type. But it has evil sides
            //http://komlenic.com/244/8-reasons-why-mysqls-enum-data-type-is-evil/+


            $table->string('payment_type');
            $table->unsignedDecimal('payment_amount', $precision = 7, $scale = 2);
            $table->unsignedSmallInteger('department_id');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('department_id')->references('id')->on('departments');
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
