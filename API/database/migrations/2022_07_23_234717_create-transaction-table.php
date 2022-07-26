<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->engine = 'InnoDB'; //engine de la tabla

            $table->bigIncrements('id')->unsigned(); //valores no negativos
            $table->string('name', 255);
            $table->string('type', 255);
            $table->integer('quantity');
            $table->foreignId('product_id');
            $table->timestamps(); //añade dos campos, cuando se crea y cuando se actualiza
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    //
    }
};
