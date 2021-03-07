<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
		$this->call(ServiceSeeder::class);
    	DB::table('faculties')->insert([
    		'id' => 17,
			'name' => 'Pasca Sarjana'
    	]);
	}
}
