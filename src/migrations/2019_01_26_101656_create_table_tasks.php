<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_name', 100)->unique();
            $table->string('task_group', 100)->index();
            $table->string('task_description', 255);
            $table->bigInteger('version');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');
        });

        // insert human task task
        DB::table('tasks')->insert([
            'task_name' => 'view-user',
            'task_description' => 'View User',
            'task_group' => 'manage-user',            
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('tasks')->insert([
            'task_name' => 'add-user',
            'task_description' => 'Add User',
            'task_group' => 'manage-user', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('tasks')->insert([
            'task_name' => 'edit-user',
            'task_description' => 'Edit User',
            'task_group' => 'manage-user', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('tasks')->insert([
            'task_name' => 'remove-user',
            'task_description' => 'Remove User',
            'task_group' => 'manage-user', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);

        // insert human task task
        DB::table('tasks')->insert([
            'task_name' => 'restore-user',
            'task_description' => 'Restore User',
            'task_group' => 'manage-user', 
            'version' => 0,
            'created_by' => -1,
            'updated_by' => -1,
            'created_at' => date("YmdHis"),
            'updated_at' => date("YmdHis")
        ]);
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
}
