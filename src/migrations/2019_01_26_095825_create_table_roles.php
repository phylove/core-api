<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_code', 50)->unique();
            $table->string('role_name', 100);
            $table->string('role_description', 255);
            $table->bigInteger('version');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');
        });

        $roleId = DB::table('roles')->insertGetId([
            'role_code' => 'administrator',
            'role_name' => 'Administrator',
            'role_description' => 'Super User have fully task on the system',
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        DB::table('roles')->insert([
            'role_code' => 'customer',
            'role_name' => 'Customer',
            'role_description' => 'User Customer',
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        DB::table('roles')->insert([
            'role_code' => 'warehouse',
            'role_name' => 'Admin Warehouse',
            'role_description' => 'Admin Warehouse',
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        DB::table('roles')->insert([
            'role_code' => 'vendor',
            'role_name' => 'Vendor',
            'role_description' => 'Vendor',
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        DB::table('roles')->insert([
            'role_code' => 'projectManager',
            'role_name' => 'Project Manager',
            'role_description' => 'Project Manager',
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        DB::table('users')->insert([
            'username' => 'superuser',
            'email' => 'superuser@localhost',
            'password' => password_hash('superuser', PASSWORD_BCRYPT),
            'full_name' => 'Super User',
            'role_id' => $roleId,
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => -1,
            'updated_at' => -1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
