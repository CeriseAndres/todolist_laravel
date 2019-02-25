<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todoactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->integer('status_id')->unsigned()->default(1);
            $table->integer('user_id')->unsigned();
            $table->integer('todolist_id')->unsigned();
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
        Schema::dropIfExists('todoactions');
    }
}
