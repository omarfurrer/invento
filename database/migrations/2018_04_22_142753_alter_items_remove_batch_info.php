<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterItemsRemoveBatchInfo extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['initial_quantity', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items',
                      function (Blueprint $table) {
            $table->float('initial_quantity', 8, 2)->after('description');
            $table->date('expires_at')->nullable()->after('price');
        });
    }

}
