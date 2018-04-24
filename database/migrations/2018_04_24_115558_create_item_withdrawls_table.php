<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemWithdrawlsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_withdrawls',
                       function (Blueprint $table) {
            $table->increments('id');
            $table->float('quantity', 8, 2);
            $table->integer('item_batch_id')->unsigned()->index();
            $table->foreign('item_batch_id')->references('id')->on('item_batches')->onDelete('cascade');
            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('item_withdrawls');
    }

}
