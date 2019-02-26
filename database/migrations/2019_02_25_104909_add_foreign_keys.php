<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('todoaction_id')->references('id')->on('todoactions')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
          	Schema::table('todoactions', function(Blueprint $table) {
                $table->foreign('todolist_id')->references('id')->on('todolists')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->foreign('status_id')->references('id')->on('statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            });
                Schema::table('user_todolist', function(Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
                    $table->foreign('todolist_id')->references('id')->on('todolists')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                });
                    Schema::table('user_todoaction', function(Blueprint $table) {
                        $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
                        $table->foreign('todoaction_id')->references('id')->on('todoactions')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
                    });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
        });
            Schema::table('comments', function(Blueprint $table) {
                $table->dropForeign('comments_todoaction_id_foreign');
            });
                Schema::table('todoactions', function(Blueprint $table) {
                    $table->dropForeign('todoactions_todolist_id_foreign');
                });
                    Schema::table('todoactions', function(Blueprint $table) {
                        $table->dropForeign('todoactions_status_id_foreign');
                    });
                        Schema::table('user_todolist', function(Blueprint $table) {
                            $table->dropForeign('user_todolist_user_id_foreign');
                        });
                            Schema::table('user_todolist', function(Blueprint $table) {
                                $table->dropForeign('user_todolist_todolist_id_foreign');
                            });
                                Schema::table('user_todoaction', function(Blueprint $table) {
                                    $table->dropForeign('user_todoaction_user_id_foreign');
                                });
                                    Schema::table('user_todoaction', function(Blueprint $table) {
                                        $table->dropForeign('user_todoaction_todoaction_id_foreign');
                                    });
    }
}
