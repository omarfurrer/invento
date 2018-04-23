<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemBatchesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_batches',
                       function (Blueprint $table) {
            $table->increments('id');
            $table->float('quantity', 8, 2);
            $table->date('expiry_date')->nullable();
            $table->float('unit_price', 8, 2)->nullable();
            $table->float('current_quantity', 8, 2)->nullable();
            $table->boolean('is_initial')->default(0);
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('item_batches');
    }

}
