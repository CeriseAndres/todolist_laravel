<?php

use Illuminate\Database\Seeder;

class UserTodoactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 0; $i < 20; $i++)
    	{
    		DB::table('user_todoaction')->insert([
    				'user_id' => rand(1,20),
    				'todoaction_id' => rand(1,20),
    		]);
    	}
    	
    }
}
