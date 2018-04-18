<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items',
                       function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->float('initial_quantity', 8, 2);
            $table->float('current_quantity', 8, 2)->nullable();
            $table->float('minimum_quantity', 8, 2)->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->date('expires_at')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_initially_approved')->default(0);
            $table->dateTime('initially_approved_at')->nullable();
            $table->integer('unit_id')->unsigned()->index();
            $table->foreign('unit_id')->references('id')->on('measurement_units');
            $table->integer('supplier_id')->unsigned()->index()->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
        Schema::dropIfExists('items');
    }

}
