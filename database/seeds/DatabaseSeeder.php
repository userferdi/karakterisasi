<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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

		DB::table('users')->insert([
			'name' => 'Admin',
	        'email' => 'admin@finder.ac.id',
	        'password' => Hash::make('printgadmin'),
	        'email_verified_at' => date('Y-m-d H:i:s')
		]);
		DB::table('model_has_roles')->insert([
			'role_id' => '1',
			'model_type' => 'App\User',
			'model_id' => '1',
		]);
		DB::table('users')->insert([
			'name' => 'Dosen Unpad',
	        'email' => 'dosenunpad@finder.ac.id',
	        'password' => Hash::make('printgadmin'),
	        'email_verified_at' => date('Y-m-d H:i:s')
		]);
		DB::table('model_has_roles')->insert([
			'role_id' => '2',
			'model_type' => 'App\User',
			'model_id' => '2',
		]);
		DB::table('profiles')->insert([
			'user_id' => '2',
			'no_id' => '1403100000',
			'no_hp' => '081200000000',
			'university' => 'Universitas Padjadjaran',
			'faculty' => 'FMIPA',
			'study_program' => 'Fisika',
		]);
		DB::table('users')->insert([
			'name' => 'Dosen Non Unpad',
	        'email' => 'dosennonunpad@finder.ac.id',
	        'password' => Hash::make('printgadmin'),
	        'email_verified_at' => date('Y-m-d H:i:s')
		]);
		DB::table('model_has_roles')->insert([
			'role_id' => '3',
			'model_type' => 'App\User',
			'model_id' => '3',
		]);
		DB::table('profiles')->insert([
			'user_id' => '3',
			'no_id' => '1403100000',
			'no_hp' => '081200000000',
			'university' => 'Universitas Non Padjadjaran',
			'faculty' => 'FMIPA',
			'study_program' => 'Fisika',
		]);
		DB::table('users')->insert([
			'name' => 'Mahasiswa Unpad',
	        'email' => 'mahasiswaunpad@finder.ac.id',
	        'password' => Hash::make('printgadmin'),
	        'email_verified_at' => date('Y-m-d H:i:s')
		]);
		DB::table('model_has_roles')->insert([
			'role_id' => '4',
			'model_type' => 'App\User',
			'model_id' => '4',
		]);
		DB::table('profiles')->insert([
			'user_id' => '4',
			'no_id' => '1403100000',
			'no_hp' => '081200000000',
			'university' => 'Universitas Padjadjaran',
			'faculty' => 'FMIPA',
			'study_program' => 'Fisika',
			'email_lecturer' => 'dosenunpad@finder.ac.id',
		]);
		DB::table('users')->insert([
			'name' => 'Mahasiswa Non Unpad',
	        'email' => 'mahasiswanonunpad@finder.ac.id',
	        'password' => Hash::make('printgadmin'),
	        'email_verified_at' => date('Y-m-d H:i:s')
		]);
		DB::table('model_has_roles')->insert([
			'role_id' => '5',
			'model_type' => 'App\User',
			'model_id' => '5',
		]);
		DB::table('profiles')->insert([
			'user_id' => '5',
			'no_id' => '1403100000',
			'no_hp' => '081200000000',
			'university' => 'Universitas Non Padjadjaran',
			'faculty' => 'FMIPA',
			'study_program' => 'Fisika',
			'email_lecturer' => 'dosennonunpad@finder.ac.id',
		]);
		DB::table('users')->insert([
			'name' => 'User Umum',
	        'email' => 'userumum@finder.ac.id',
	        'password' => Hash::make('printgadmin'),
	        'email_verified_at' => date('Y-m-d H:i:s')
		]);
		DB::table('model_has_roles')->insert([
			'role_id' => '6',
			'model_type' => 'App\User',
			'model_id' => '6',
		]);

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
			'name' => '08:00-09:00',
			'time_start' => '08:00',
			'time_end' => '09:00',
		]); 
		DB::table('times')->insert([
			'name' => '09:00-10:00',
			'time_start' => '09:00',
			'time_end' => '10:00',
		]); 
		DB::table('times')->insert([
			'name' => '10:00-11:00',
			'time_start' => '10:00',
			'time_end' => '11:00',
		]);
		DB::table('times')->insert([
			'name' => '11:00-12:00',
			'time_start' => '11:00',
			'time_end' => '12:00',
		]);
		DB::table('times')->insert([
			'name' => '13:00-14:00',
			'time_start' => '13:00',
			'time_end' => '14:00',
		]);
		DB::table('times')->insert([
			'name' => '14:00-15:00',
			'time_start' => '14:00',
			'time_end' => '15:00',
		]);
		DB::table('times')->insert([
			'name' => '15:00-16:00',
			'time_start' => '15:00',
			'time_end' => '16:00',
		]);
		DB::table('times')->insert([
			'name' => '16:00-17:00',
			'time_start' => '16:00',
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
		for($i=1;$i<9;$i++){
			DB::table('time_usage')->insert([
				'usage_id' => 1,
				'time_id' => $i,
			]);
		}
		for($i=9;$i<11;$i++){
			DB::table('time_usage')->insert([
				'usage_id' => 2,
				'time_id' => $i,
			]);
		}
		DB::table('time_usage')->insert([
			'usage_id' => 3,
			'time_id' => 11,
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

		// FacultySeeder
		DB::table('faculties')->insert([
			'name' => 'Fakultas Hukum (FH)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Ekonomi dan Bisnis (FEB)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Kedokteran (FK)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Pertanian (FAPERTA)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Kedokteran Gigi (FKG)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Ilmu Budaya (FIB)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Ilmu Sosial dan Ilmu Politik (FISIP)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Psikologi (FAPSI)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Peternakan (FAPET)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Ilmu Komunikasi (FIKOM)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Keperawatan (FKEP)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Perikanan dan Ilmu Kelautan (FPIK)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Teknologi Industri Pertanian (FTIP)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Farmasi (FF)'
		]);
		DB::table('faculties')->insert([
			'name' => 'Fakultas Teknik Geologi (FTG)'
		]);

		// StudyProgramSeeder
		DB::table('study_programs')->insert([
			'name' => 'Hukum',
			'faculties_id' => 1
		]);
		DB::table('study_programs')->insert([
			'name' => 'Akuntansi',
			'faculties_id' => 2
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ekonomi Pembangunan',
			'faculties_id' => 2
		]);
		DB::table('study_programs')->insert([
			'name' => 'Manajemen',
			'faculties_id' => 2
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ekonomi Islam',
			'faculties_id' => 2
		]);
		DB::table('study_programs')->insert([
			'name' => 'Bisnis Digital',
			'faculties_id' => 2
		]);
		DB::table('study_programs')->insert([
			'name' => 'Akuntansi',
			'faculties_id' => 2
		]);
		DB::table('study_programs')->insert([
			'name' => 'Kedokteran',
			'faculties_id' => 3
		]);
		DB::table('study_programs')->insert([
			'name' => 'Kedokteran Hewan',
			'faculties_id' => 3
		]);
		DB::table('study_programs')->insert([
			'name' => 'Matematika',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Kimia',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Fisika',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Biologi',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Statistika',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Geofisika',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Teknik Informatika',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Teknik Elektro',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Aktuaria',
			'faculties_id' => 4
		]);
		DB::table('study_programs')->insert([
			'name' => 'Agroteknologi',
			'faculties_id' => 5
		]);
		DB::table('study_programs')->insert([
			'name' => 'Agribisnis',
			'faculties_id' => 5
		]);
		DB::table('study_programs')->insert([
			'name' => 'Kedokteran Gigi',
			'faculties_id' => 6
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Indonesia',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Sunda',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Sejarah',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Inggris',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Perancis',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Jepang',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Rusia',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Jerman',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Arab',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sastra Indonesia',
			'faculties_id' => 7
		]);
		DB::table('study_programs')->insert([
			'name' => 'Administrasi Publik',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Hubungan Internasional',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Kesejahteraan Sosial',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Pemerintahan',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Antropologi',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Administrasi Bisnis',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Sosiologi',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Politik',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Administrasi Bisnis PSDKU Pangandaran',
			'faculties_id' => 8
		]);
		DB::table('study_programs')->insert([
			'name' => 'Psikologi',
			'faculties_id' => 9
		]);
		DB::table('study_programs')->insert([
			'name' => 'Peternakan',
			'faculties_id' => 10
		]);
		DB::table('study_programs')->insert([
			'name' => 'Peternakan PSDKU Pangandaran',
			'faculties_id' => 10
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Komunikasi',
			'faculties_id' => 11
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Perpustakaan',
			'faculties_id' => 11
		]);
		DB::table('study_programs')->insert([
			'name' => 'Hubungan Masyarakat',
			'faculties_id' => 11
		]);
		DB::table('study_programs')->insert([
			'name' => 'Jurnalistik',
			'faculties_id' => 11
		]);
		DB::table('study_programs')->insert([
			'name' => 'Manajemen Komunikasi',
			'faculties_id' => 11
		]);
		DB::table('study_programs')->insert([
			'name' => 'Televisi dan Film',
			'faculties_id' => 11
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Komunikasi PSDKU Pangandaran',
			'faculties_id' => 11
		]);
		DB::table('study_programs')->insert([
			'name' => 'Keperawatan',
			'faculties_id' => 12
		]);
		DB::table('study_programs')->insert([
			'name' => 'Keperawatan PSDKU Pangandaran',
			'faculties_id' => 12
		]);
		DB::table('study_programs')->insert([
			'name' => 'Perikanan',
			'faculties_id' => 13
		]);
		DB::table('study_programs')->insert([
			'name' => 'Ilmu Kelautan',
			'faculties_id' => 13
		]);
		DB::table('study_programs')->insert([
			'name' => 'Perikanan PSDKU Pangandaran',
			'faculties_id' => 13
		]);
		DB::table('study_programs')->insert([
			'name' => 'Teknik Pertanian dan Biosistem',
			'faculties_id' => 14
		]);
		DB::table('study_programs')->insert([
			'name' => 'Teknologi Pangan',
			'faculties_id' => 14
		]);
		DB::table('study_programs')->insert([
			'name' => 'Teknologi Industri Pertanian',
			'faculties_id' => 14
		]);
		DB::table('study_programs')->insert([
			'name' => 'Farmasi',
			'faculties_id' => 15
		]);
		DB::table('study_programs')->insert([
			'name' => 'Teknik Geologi',
			'faculties_id' => 16
		]);

		// LabSeeder
		DB::table('labs')->insert([
			'name' => 'Laboratorium Karakterisasi',
			'code' => 'LAB-KTS',
			'head' => ' Prof. Dr. Eng. I Made Joni, M.Sc.',
			'descrip' => 'Laboratorium Karakterisasi menyediakan berbagai macam alat karakterisasi seperti Particle Size Analyzer, Zeta Potensial, X-Ray Fluorescence, Photoluminescence, Fourier-Transform Infrared Spectroscopy, dan alat-alat karakterisasi lainnya.',
		]);

		$this->call(ServiceSeeder::class);
	}
}
