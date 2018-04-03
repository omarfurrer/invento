<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

class AddBaseRoles extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create(['name' => 'employee']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'super admin']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::whereIn('name', ['employee', 'admin', 'super admin'])->delete();
    }

}
