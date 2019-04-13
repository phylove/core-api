<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitCategoryFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_product_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_code', 100)->unique();
            $table->string('category_name', 100);
            $table->string('icon_name', 30);
            $table->bigInteger('category_parent_id')->default(-1);
            $table->bigInteger('version');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');        
        });

        $categoryTasks = ['addProductCategory', 'editProductCategory', 'removeProductCategory', 'restoreProductCategory'];
        foreach($categoryTasks as $task){
            // insert human task task
            DB::table('tasks')->insert([
                'task_name' => $task,
                'task_description' => strtoupper($task),
                'task_group' => 'category', 
                'version' => 0,
                'created_by' => -1,
                'updated_by' => -1,
                'created_at' => date("YmdHis"),
                'updated_at' => date("YmdHis")
            ]);
        }

        DB::statement(
            "INSERT INTO role_task(role_id, task_id, version, created_by, updated_by, created_at, updated_at)
            SELECT B.id, A.id, 0, -1, -1, ".date("YmdHis").", ".date("YmdHis")." 
                FROM tasks A, roles B 
            WHERE A.task_group='category' AND B.role_code='administrator'"
        );
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
