<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log',
                       function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->float('quantity', 8, 2);
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('item_batch_id')->unsigned()->index()->nullable();
            $table->foreign('item_batch_id')->references('id')->on('item_batches')->onDelete('cascade');
            $table->integer('item_withdrawl_id')->unsigned()->index()->nullable();
            $table->foreign('item_withdrawl_id')->references('id')->on('item_withdrawls')->onDelete('cascade');
            $table->boolean('in')->default(0);
            $table->float('item_current_quantity');
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
        Schema::dropIfExists('log');
    }

}
