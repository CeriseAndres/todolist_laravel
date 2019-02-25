<?php

use Illuminate\Database\Seeder;

class TodoactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory ( App\Todoaction::class, 10)->create ();
    }
}
