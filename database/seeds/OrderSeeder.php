<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create('id_ID');
		// OrderSeeder
		for($i = 1; $i <= 1000; $i++){
    		DB::table('orders')->insert([
		        'users_id' => $faker->numberBetween(1,500),
		        'tools_id' => $faker->numberBetween(1,50),
		        'attend' => 'on',
		        'plans_id' => $faker->numberBetween(1,2),
		        'purpose' => $faker->text,
		        'sample' => $faker->text,
		        'unique' => $faker->text,
		        'created_at' => $faker->dateTime($max = 'now'),
		        'updated_at' => $faker->dateTime($max = 'now'),
    		]);
    	}

		// BookingSeeder
		for($i = 1; $i <= 1000; $i++){
			DB::table('bookings')->insert([
		        'users_id' => $faker->numberBetween(1,500),
		        'order_id' => $faker->numberBetween(1,100),
		        'no_form' => $faker->regexify('[A-Z]{3}'),
		        'date1' => $faker->date($format = 'Y-m-d', $max = 'now'),
		        'times1_id' => $faker->numberBetween(1,7),
		        'date2' => $faker->date($format = 'Y-m-d', $max = 'now'),
		        'times2_id' => $faker->numberBetween(1,7),
		        'date3' => $faker->date($format = 'Y-m-d', $max = 'now'),
		        'times3_id' => $faker->numberBetween(1,7),
		        'token' => str::random(60),
		        'status' => $faker->numberBetween(1,9),
		        'datetime' => $faker->numberBetween(1,3),
		        'note' => $faker->text,
		        'created_at' => $faker->dateTime($max = 'now'),
		        'updated_at' => $faker->dateTime($max = 'now'),
    		]);
    	}

		// ApproveSeeder
		for($i = 1; $i <= 100; $i++){
			DB::table('approves')->insert([
		        'users_id' => $faker->numberBetween(1,500),
		        'order_id' => $faker->numberBetween(1,100),
		        'no_regis' => $faker->regexify('[A-Z]{3}'),
		        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
		        'times_id' => $faker->numberBetween(1,7),
		        'status' => $faker->numberBetween(1,4),
		        'created_at' => $faker->dateTime($max = 'now'),
		        'updated_at' => $faker->dateTime($max = 'now'),
    		]);
    	}
    }
}
