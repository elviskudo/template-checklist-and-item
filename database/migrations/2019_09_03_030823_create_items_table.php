<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->boolean('is_completed');
            $table->integer('completed_by')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('due')->nullable();
            $table->integer('due_interval')->nullable();
            $table->string('due_unit')->nullable();
            $table->integer('urgency')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('checklist_id')->nullable();
            $table->integer('assignee_id')->nullable();
            $table->string('task_id')->nullable();
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
        Schema::dropIfExists('table_item');
    }
}
