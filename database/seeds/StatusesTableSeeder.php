<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Status::create(
    	 [
			'label' => 'A faire',
    			            ]
    	            );
    	Status::create(
    	            [
    	                'label' => 'En cours',
    	            ]
    	            );
    	Status::create(
    			            [
    					                'label' => 'Achevé',
    	            ]
    	            );
    	        Status::create(
    			            [
    					                'label' => 'Archivé',
    	            ]
    	            );
    }
}
