<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class InputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create('id_ID');
		// LabSeeder
		for($i = 1; $i <= 10; $i++){
    		DB::table('labs')->insert([
		        'name' => $faker->company,
		        'code' => $faker->regexify('[A-Z]{3}'),
		        'head' => $faker->name,
		        'descrip' => $faker->text,
    		]);
    	}

		// ToolSeeder
		for($i = 1; $i <= 50; $i++){
    		DB::table('tools')->insert([
		        'name' => $faker->company,
		        'code' => $faker->regexify('[A-Z]{3}'),
		        'descrip' => $faker->text,
		        'sample' => $faker->text,
		        'labs_id' => $faker->numberBetween(1,10),
		        'actives_id' => $faker->numberBetween(1,2),
		        'usages_id' => $faker->numberBetween(1,3),
    		]);
    	}

		// PriceSeeder
		for($i = 1; $i <= 200; $i++){
    		DB::table('prices')->insert([
				'service' => $faker->company,
		        'price1' => $faker->numberBetween(100000,1000000),
		        'price2' => $faker->numberBetween(100000,1000000),
		        'price3' => $faker->numberBetween(100000,1000000),
		        'discount' => $faker->numberBetween(0,25),
		        'tools_id' => $faker->numberBetween(1,50),
    		]);
    	}

		// UserSeeder
		for($i = 1; $i <= 500; $i++){
			$role = $faker->numberBetween(1,6);
			if($role == 1){
	    		DB::table('users')->insert([
					'name' => $faker->name,
			        'email' => $faker->unique()->email,
			        'password' => Hash::make('isengaja'),
	    		]);
	    		DB::table('model_has_roles')->insert([
					'role_id' => $role,
					'model_type' => 'App\User',
					'model_id' => $i,
	    		]);
			}
			else if($role == 2){
	    		$id = DB::table('users')->insertGetId([
					'name' => $faker->name,
			        'email' => $faker->unique()->email,
			        'password' => Hash::make('isengaja'),
	    		]);
	    		DB::table('model_has_roles')->insert([
					'role_id' => $role,
					'model_type' => 'App\User',
					'model_id' => $i,
	    		]);
	    		DB::table('profiles')->insert([
	    			'user_id' => $id,
			        'no_id' => $faker->nik,
			        'no_hp' => $faker->phonenumber,
			        'university' => 'Universitas Padjadjaran',
			        'faculty' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
			        'study_program' => 'Fisika',
	    		]);
			}
			else if($role == 3){
	    		$id = DB::table('users')->insertGetId([
					'name' => $faker->name,
			        'email' => $faker->unique()->email,
			        'password' => Hash::make('isengaja'),
	    		]);
	    		DB::table('model_has_roles')->insert([
					'role_id' => $role,
					'model_type' => 'App\User',
					'model_id' => $i,
	    		]);
	    		DB::table('profiles')->insert([
	    			'user_id' => $id,
			        'no_id' => $faker->nik,
			        'no_hp' => $faker->phonenumber,
			        'university' => 'Universitas Indonesia',
			        'faculty' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
			        'study_program' => 'Fisika',
	    		]);
			}
			else if($role == 4){
	    		$id = DB::table('users')->insertGetId([
					'name' => $faker->name,
			        'email' => $faker->unique()->email,
			        'password' => Hash::make('isengaja'),
	    		]);
	    		DB::table('model_has_roles')->insert([
					'role_id' => $role,
					'model_type' => 'App\User',
					'model_id' => $i,
	    		]);
	    		DB::table('profiles')->insert([
	    			'user_id' => $id,
			        'no_id' => $faker->nik,
			        'no_hp' => $faker->phonenumber,
			        'university' => 'Universitas Padjadjaran',
			        'faculty' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
			        'study_program' => 'Fisika',
	    		]);
			}
			else if($role == 5){
	    		$id = DB::table('users')->insertGetId([
					'name' => $faker->name,
			        'email' => $faker->unique()->email,
			        'password' => Hash::make('isengaja'),
	    		]);
	    		DB::table('model_has_roles')->insert([
					'role_id' => $role,
					'model_type' => 'App\User',
					'model_id' => $i,
	    		]);
	    		DB::table('profiles')->insert([
	    			'user_id' => $id,
			        'no_id' => $faker->nik,
			        'no_hp' => $faker->phonenumber,
			        'university' => 'Universitas Indonesia',
			        'faculty' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
			        'study_program' => 'Fisika',
	    		]);
			}
			else if($role == 6){
	    		$id = DB::table('users')->insertGetId([
					'name' => $faker->name,
			        'email' => $faker->unique()->email,
			        'password' => Hash::make('isengaja'),
	    		]);
	    		DB::table('model_has_roles')->insert([
					'role_id' => $role,
					'model_type' => 'App\User',
					'model_id' => $i,
	    		]);
	    		DB::table('profiles')->insert([
	    			'user_id' => $id,
			        'no_id' => $faker->nik,
			        'no_hp' => $faker->phonenumber,
			        'institution' => $faker->company,
			        'address' => $faker->address,
	    		]);
			}
    	}
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
