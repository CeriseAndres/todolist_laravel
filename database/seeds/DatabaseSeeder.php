<?php

use Illuminate\Database\Seeder;
use App\Status;
use App\Todolist;
use App\Comment;
use App\User;
use App\Todoaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(StatusesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TodolistsTableSeeder::class);
        $this->call(TodoactionsTableSeeder::class);
        $this->call(UserTodolistTableSeeder::class);
        $this->call(UserTodoactionTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
    
}
