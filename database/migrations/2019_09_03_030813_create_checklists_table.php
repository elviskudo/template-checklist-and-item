<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('object_domain');
            $table->string('object_id');
            $table->string('description');
            $table->boolean('is_completed');
            $table->dateTime('completed_at')->nullable();
            $table->string('last_updated_by')->nullable();
            $table->dateTime('due')->nullable();
            $table->integer('due_interval')->nullable();
            $table->string('due_unit')->nullable();
            $table->integer('urgency')->nullable();
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
        Schema::dropIfExists('table_checklist');
    }
}
