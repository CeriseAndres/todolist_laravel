<?php

use Illuminate\Database\Seeder;

class UserTodolistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 1; $i < 20; $i++)
    	{
    		DB::table('user_todolist')->insert([
    				'user_id' => $i,
    				'todolist_id' => rand(1,20),
    		]);
    	}
    	
    }
}
