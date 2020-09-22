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

		// LabSeeder
		DB::table('labs')->insert([
			'name' => 'Laboratorium Nanomaterial',
			'code' => 'LAB-NM',
			'head' => 'Dr. Veinardi Suendo S.Si.,M.Eng.',
			'descrip' => 'Laboratorium ini memiliki fasilitas untuk sintesis material seperti thin film, baterai, dll. Terdapat Wet Process Lab, dry process lab, dan clean room untuk preparasi. Laboratorium ini juga menyediakan alat untuk proses deposisi thin film seperti dip coating, spin coating, dan vacuum evaporator. Selain itu, laboratorium ini juga dilengkapi dengan alat karakterisasi seperti TG/DTA, FTIR, dan alata karakterisasi elektronik lainnya.',
		]);
		DB::table('labs')->insert([
			'name' => 'Laboratorium Mikroskop Elektron',
			'code' => 'LAB-ME',
			'head' => 'Dr. Damar Rastri Adhika ST, M.Sc.',
			'descrip' => 'Laboratorium Mikroskop elektron berisi beberapa alat karakterisasi material, diantaranya adalah XRD, XRF, SEM, TEM, AFM, UV/Vis Spectroscopy, NIR Spectroscopy, dan Ellipsometer. Selain itu juga ada beberapa alat khusus untuk preparasi sampel TEM seperti FIB, Ultramicrotome, TEM Mill, Mechanical Polishing, Electropolishing, Dimpler, serta Pecision Saw.',
		]);
		DB::table('labs')->insert([
			'name' => 'Laboratorium Nano Bio',
			'code' => 'LAB-NB',
			'head' => 'Azzania Fibriani S.Si.,M.Si.,Ph.D.',
			'descrip' => 'Laboratorium ini terdiri dari beberapa ruangan meliputi ruang molekuler biologi, kultur mikrobia, bioproses , ruang dingin, sterilisasi, fermenter, dll.',
		]);
		DB::table('labs')->insert([
			'name' => 'Laboratorium Computational Material Design',
			'code' => 'LAB-CMD',
			'head' => 'Mohammad Kemal Agusta ST,M.Eng.,Ph.D.',
			'descrip' => 'Laboratorium ini menggunakan dan mengelola fasilitas High Perfomance Computer (>500 core) serta berbagai perangkat lunak untuk keperluan kalkulasi/simulasi/perancangan nanomaterial.',
		]);
		DB::table('labs')->insert([
			'name' => 'Laboratorium Nano Farmasi',
			'code' => 'LAB-NB',
			'head' => 'Prof. Dr. Heni Rachmawati Apt.,M.Si.',
			'descrip' => 'Laboratorium ini menyediakan fasilitas Ball Mill untuk keperluan nano grinding, size reduction, homogenizing, mechanical alloying, colloidal milling dan high energy comminution.',
		]);

		// ToolSeeder
		DB::table('tools')->insert([
			'name' => 'Scanning Electron Microscope SU3500',
			'code' => 'SEM',
			'descrip' => 'Scanning Electron Microscope (SEM) adalah alat untuk mencitrakan detail permukaan sampel dalam resolusi tinggi. Perbesaran maksimum SEM SU3500 adalah 300.000 kali, namun nilai perbesaran ini akan dibatasi oleh jenis dan kualitas sampel yang diamati. Untuk pengamatan SEM, sampel tidak dapat mengandung cairan atau berada dalam fasa cair. Pada SEM dapat dilakukan analisis Energy Dispersive X-Ray Spectroscopy (EDS).',
			'sample' => '1. Sampel harus diamati dalam keadaan kering dan tidak mengandung cairan. 2. Harap jelaskan detail sampel yang akan diamati, target perbesaran gambar, dan permohonan khusus (contoh: jika membutuhkan pengeringan dengan HMDS atau akan melakukan pengamatan cross-section). 3. Untuk EDS harap cantumkan prediksi unsur-unsur yang terdapat pada sampel. 4. PPNN tidak membuka layanan preparasi sampel biologi yang membutuhkan fiksasi dan dehidrasi. Keterangan Tambahan : Apabila sampel dititipkan, user harus mendeskripsikan dengan detail tujuan pengamatan dan melampirkan contoh hasil pengamatan (dari referensi atau pengamatan terdahulu) jika ada.',
			'labs_id' => 2,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('tools')->insert([
			'name' => 'X-Ray Fluorescence',
			'code' => 'XRF',
			'descrip' => 'Alat untuk karakterisasi komposisi unsur pada sampel dengan memanfaatkan X-ray characteristic.',
			'sample' => 'Sampel untuk karakterisasi XRF dapat berupa padatan atau serbuk yang telah dipadatkan (pellet) dengan berat sampel mimimum yang disarankan adalah 20 mg.',
			'labs_id' => 2,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('tools')->insert([
			'name' => 'X-Ray Diffractometer',
			'code' => 'XRD',
			'descrip' => 'Alat ini digunakan untuk menganalisis jenis , komposisi, dan fasa senyawa pada sampel. Hasil pengujian berupa raw data berekstensi *.raw dan *.brml',
			'sample' => 'Sampel untuk karakterisasi XRD harus memenuhi kriteria sbb: 1.Sampel dapat berupa serbuk/padatan/lapisan tipis dengan volume minimal 2 ml. Berat sampel tidak ditentukan karena tergantung massa jenis material. 2. Untuk serbuk harus homogen dan halus yaitu dengan ukuran dibawah 40 mikron (lebih baik pada rentang 5-20 mikron) 3. Untuk padatan permukaannya harus benar-benar rata dengan dimensi 15±1 mm x 15±1 mm x 1,1 mm. 4. Untuk lapisan tipis harus cukup tebal agar bukan substrat yang terdeteksi. Ketebalan minimum yang disarankan adalah sekitar 50 mikron.',
			'labs_id' => 2,
			'actives_id' => 1,
			'usages_id' => 1,
		]);

		// PriceSeeder
		DB::table('prices')->insert([
			'service' => 'X-Ray Fluorescence Characterization (per spektrum)',
			'price1' => 200000,
			'price2' => 300000,
			'price3' => 450000,
			'discount' => 10,
			'tools_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'X-Ray Fluorescence Characterization (per map)',
			'price1' => 250000,
			'price2' => 375000,
			'price3' => 550000,
			'discount' => 0,
			'tools_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'X-Ray Diffractometer Characterization (per sample)',
			'price1' => 275000,
			'price2' => 400000,
			'price3' => 550000,
			'discount' => 10,
			'tools_id' => 3,
		]);
		DB::table('prices')->insert([
			'service' => 'SEM SU3500 Imaging',
			'price1' => 275000,
			'price2' => 400000,
			'price3' => 550000,
			'discount' => 0,
			'tools_id' => 1,
		]);
		DB::table('prices')->insert([
			'service' => 'Ion Sputtering : Gold Coating',
			'price1' => 275000,
			'price2' => 400000,
			'price3' => 550000,
			'discount' => 10,
			'tools_id' => 1,
		]);
	}
}
