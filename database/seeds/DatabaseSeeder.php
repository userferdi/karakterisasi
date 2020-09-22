<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	// RoleSeeder
        $name = ['Admin', 'Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        for($i=0;$i<6;$i++){
			DB::table('roles')->insert([
	        	'name' => $name[$i],
	        	'guard_name' => 'web',
	        ]);
        }

        // PermissionSeeder
		// $name = ['Client', 'Dosen', 'Mahasiswa', 'Unpad', 'Non Unpad'];
		// for($i=0;$i<5;$i++){
		// 	DB::table('permissions')->insert([
		// 		'name' => $name[$i],
		// 		'guard_name' => 'web',
		// 	]);
		// }

        // RoleHasPermissionSeeder
		// for($i=2;$i<7;$i++){
		// 	DB::table('role_has_permissions')->insert([
		// 		'permission_id' => 1,
		// 		'role_id' => $i,
		// 	]);
		// }
		// for($i=2;$i<4;$i++){
		// 	DB::table('role_has_permissions')->insert([
		// 		'permission_id' => 2,
		// 		'role_id' => $i,
		// 	]);
		// }
		// for($i=4;$i<6;$i++){
		// 	DB::table('role_has_permissions')->insert([
		// 		'permission_id' => 3,
		// 		'role_id' => $i,
		// 	]);
		// }
		// for($i=2;$i<5;$i+=2){
		// 	DB::table('role_has_permissions')->insert([
		// 		'permission_id' => 4,
		// 		'role_id' => $i,
		// 	]);
		// }
		// for($i=3;$i<6;$i+=2){
		// 	DB::table('role_has_permissions')->insert([
		// 		'permission_id' => 5,
		// 		'role_id' => $i,
		// 	]);
		// }

		// ActiveSeeder
		DB::table('actives')->insert([
	        'name' => 'Active',
		]); 
		DB::table('actives')->insert([
			'name' => 'Inactive',
		]);

		// UsageSeeder
		DB::table('usages')->insert([
			'name' => 'Per-jam',
		]); 
		DB::table('usages')->insert([
			'name' => 'Per-sesi',
		]);
		DB::table('usages')->insert([
			'name' => 'Per-hari',
		]);

		// TimeSeeder
		DB::table('times')->insert([
			'name' => '08:00-10:00',
			'time_start' => '08:00',
			'time_end' => '10:00',
		]); 
		DB::table('times')->insert([
			'name' => '10:00-12:00',
			'time_start' => '10:00',
			'time_end' => '12:00',
		]);
		DB::table('times')->insert([
			'name' => '13:00-15:00',
			'time_start' => '13:00',
			'time_end' => '15:00',
		]);
		DB::table('times')->insert([
			'name' => '15:00-17:00',
			'time_start' => '15:00',
			'time_end' => '17:00',
		]);
		DB::table('times')->insert([
			'name' => '08:00-12:00',
			'time_start' => '08:00',
			'time_end' => '12:00',
		]);
		DB::table('times')->insert([
			'name' => '13:00-17:00',
			'time_start' => '13:00',
			'time_end' => '17:00',
		]);
		DB::table('times')->insert([
			'name' => '08:00-17:00',
			'time_start' => '08:00',
			'time_end' => '17:00',
		]);

		// UsageTimeSeeder
		for($i=1;$i<5;$i++){
			DB::table('time_usage')->insert([
				'usage_id' => 1,
				'time_id' => $i,
			]);
		}
		for($i=5;$i<7;$i++){
			DB::table('time_usage')->insert([
				'usage_id' => 2,
				'time_id' => $i,
			]);
		}
		DB::table('time_usage')->insert([
			'usage_id' => 3,
			'time_id' => 7,
		]);

		// PlanSeeder
		DB::table('plans')->insert([
			'name' => 'Tunai',
		]);
		DB::table('plans')->insert([
			'name' => 'Transfer'
		]);
		DB::table('plans')->insert([
			'name' => 'Transfer Dosen'
		]);

	}
}
