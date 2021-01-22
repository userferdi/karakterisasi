<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	DB::table('faculties')->insert([
    		'id' => 17,
			'name' => 'Pasca Sarjana'
    	]);
		// $this->call(ServiceSeeder::class);
	}
}
