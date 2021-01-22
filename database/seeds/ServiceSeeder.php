<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
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

    	$i = 1;
		DB::table('tools')->insert([
			'name' => 'Particle Size Analyzer (PSA)',
			'code' => 'PSA',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Particle Size Analyzer (PSA)',
			'unit' => 'Per Sampel',
			'price1' => 270000,
			'price3' => 300000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Zeta Potential',
			'code' => 'ZP',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Zeta Potential',
			'unit' => 'Per Sampel',
			'price1' => 285000,
			'price3' => 325000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'X-Ray Fluorescence (XRF)',
			'code' => 'XRF',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'X-Ray Fluorescence (XRF)',
			'unit' => 'Per Sampel',
			'price1' => 280000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Spektrofluorometer',
			'code' => 'PL',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Spektrofluorometer',
			'unit' => 'Per Sampel',
			'price1' => 380000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Fourier-Transform Infrared Spectroscopy (FTIR)',
			'code' => 'mR',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Fourier-Transform Infrared Spectroscopy (FTIR)',
			'unit' => 'Per Sampel',
			'price1' => 160000,
			'price3' => 200000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Loss on Ignition (LoI)',
			'code' => 'LoI',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Loss on Ignition (LoI)',
			'unit' => 'Per Sampel',
			'price1' => 320000,
			'price3' => 350000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Preparasi Sampel',
			'code' => 'PS',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Preparasi Sampel untuk PSA, ZETA POTENTIAL',
			'unit' => 'Per Sampel/Jam',
			'price1' => 53000,
			'price3' => 55000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Analisis Zona Hambat Bakteri',
			'code' => 'AZHB',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Analisis Zona Hambat Bakteri',
			'unit' => 'Per Sampel',
			'price1' => 160000,
			'price3' => 200000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'BK 300 Internal Resistance of Battery Meter',
			'code' => 'BK-300',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'BK 300 Internal Resistance of Battery Meter',
			'unit' => 'Per Sampel',
			'price1' => 550000,
			'price3' => 650000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Programmable DC Electronic Load M9712',
			'code' => 'M9712',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Programmable DC Electronic Load M9712',
			'unit' => 'Per Sampel/Hari',
			'price1' => 1300000,
			'price3' => 1500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'BST8-Stat',
			'code' => 'BST8',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'BST8-Stat',
			'unit' => 'Per Sampel/Hari',
			'price1' => 1300000,
			'price3' => 1500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'BTS9 Battery Testing Neware',
			'code' => 'BTS9',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'BTS9 Battery Testing Neware',
			'unit' => 'Per Sampel/Hari',
			'price1' => 1300000,
			'price3' => 1500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		// Bahan Habis Pakai

		$i++;
		DB::table('tools')->insert([
			'name' => 'Beadsmill',
			'code' => 'BS',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Beadsmill Kecil',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Beadsmill Besar',
			'unit' => 'Per Sampel/Hari',
			'price1' => 800000,
			'price3' => 1000000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Jaw Crusher',
			'code' => 'JC',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Jaw Crusher Kecil',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Jaw Crusher Besar',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Lab. Pulverizer',
			'code' => 'LP',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Lab. Pulverizer',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Disc Mill',
			'code' => 'DM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Disc Mill',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Table Pressing',
			'code' => 'DM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Table Pressing',
			'unit' => 'Per Sampel/Jam',
			'price1' => 125000,
			'price3' => 150000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Drying Oven',
			'code' => 'DO',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Drying Oven Besar',
			'unit' => 'Per Sampel/Hari',
			'price1' => 150000,
			'price3' => 200000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Drying Oven Kecil Biru',
			'unit' => 'Per Sampel/Hari',
			'price1' => 80000,
			'price3' => 100000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Hammer Mill',
			'code' => 'DO',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Hammer Mill',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Shaking Table',
			'code' => 'ST',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Shaking Table',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Ball Mill',
			'code' => 'BM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Ball Mill',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Wet Ball Mill',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Ultrasonik',
			'code' => 'US',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Ultrasonik Bath',
			'unit' => 'Per Sampel/Jam',
			'price1' => 30000,
			'price3' => 35000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Ultrasonik Batang',
			'unit' => 'Per Sampel/Jam',
			'price1' => 35000,
			'price3' => 40000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Furnace MTI X1200',
			'code' => 'MTI-X1200',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Furnace MTI X1200',
			'unit' => 'Per Sampel/Hari',
			'price1' => 300000,
			'price3' => 400000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Tambahan Penggunaan Gas Nitrogen',
			'unit' => 'Per Sampel/Hari',
			'price1' => 300000,
			'price3' => 400000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Tambahan Penggunaan Gas Nitrogen',
			'unit' => 'Per Sampel/Hari',
			'price1' => 300000,
			'price3' => 400000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Tambahan Penggunaan Gas Nitrogen',
			'unit' => 'Per Sampel/Hari',
			'price1' => 300000,
			'price3' => 400000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Hot Plate Digital Magnetic Stirrer',
			'code' => 'HP-DMS',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Hot Plate Digital Magnetic Stirrer',
			'unit' => 'Per Sampel/Jam',
			'price1' => 30000,
			'price3' => 40000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Spray Pyrolysis',
			'code' => 'SP',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Spray Pyrolysis High',
			'unit' => 'Per Sampel/Hari',
			'price1' => 500000,
			'price3' => 750000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Spray Pyrolysis Low',
			'unit' => 'Per Sampel/Hari',
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Pulse Combustion Spray Pyrolysis (PCSP)',
			'code' => 'PCSP',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Pulse Combustion Spray Pyrolysis (PCSP)',
			'unit' => 'Per Sampel/Hari',
			'price1' => 800000,
			'price3' => 1000000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Sentrifuge',
			'code' => 'STF',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Sentrifuge',
			'unit' => 'Per Sampel/Jam',
			'price1' => 30000,
			'price3' => 35000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Timbangan',
			'code' => 'TBG',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Timbangan Digital',
			'unit' => 'Per Sampel/Jam',
			'price1' => 30000,
			'price3' => 35000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Timbangan Analitik',
			'unit' => 'Per Sampel/Jam',
			'price1' => 30000,
			'price3' => 35000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Mesh',
			'code' => 'MESH',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Mesh',
			'unit' => 'Per Sampel/Hari',
			'price1' => 250000,
			'price3' => 300000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Wheatering Test',
			'code' => 'WT',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Wheatering Test',
			'unit' => 'Per Sampel/40 Hari',
			'price1' => 4500000,
			'price3' => 5000000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Contact Angle',
			'code' => 'CA',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Contact Angle',
			'unit' => 'Per Sampel/Kontak/Foto',
			'price1' => 75000,
			'price3' => 100000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Desicator',
			'code' => 'DC',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Desicator',
			'unit' => 'Per Sampel/Jam',
			'price1' => 10000,
			'price3' => 15000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Autoclave Sterillzer',
			'code' => 'AS',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Autoclave Sterillzer',
			'unit' => 'Per Sampel/3 Jam',
			'price1' => 75000,
			'price3' => 100000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Meja Laminar Air Flow',
			'code' => 'LAF',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Meja Laminar Air Flow',
			'unit' => 'Per Sampel/Hari',
			'price1' => 110000,
			'price3' => 125000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Inkubator',
			'code' => 'LAF',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Inkubator',
			'unit' => 'Per Sampel/Hari',
			'price1' => 80000,
			'price3' => 100000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'pH Meter',
			'code' => 'PH',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'pH Meter',
			'unit' => 'Per Sampel/Hari',
			'price1' => 20000,
			'price3' => 30000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Micro Pump',
			'code' => 'MP',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Micro Pump',
			'unit' => 'Per Sampel/Hari',
			'price1' => 35000,
			'price3' => 40000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Evaporator',
			'code' => 'EPR',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Evaporator',
			'unit' => 'Per Sampel/Hari',
			'price1' => 200000,
			'price3' => 250000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Vacuum Oven',
			'code' => 'VO',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Vacuum Oven',
			'unit' => 'Per Sampel/Hari',
			'price1' => 100000,
			'price3' => 150000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Viscometer',
			'code' => 'VCM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Viscometer',
			'unit' => 'Per Sampel/Jam',
			'price1' => 50000,
			'price3' => 75000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Vacuum Mixer',
			'code' => 'VM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Vacuum Mixer',
			'unit' => 'Per Sampel/Jam',
			'price1' => 35000,
			'price3' => 50000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Oven',
			'code' => 'VM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Oven',
			'unit' => 'Per Sampel/Hari',
			'price1' => 80000,
			'price3' => 100000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Crimping Machine',
			'code' => 'CM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Crimping Machine',
			'unit' => 'Per Sampel/Jam',
			'price1' => 35000,
			'price3' => 50000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Punching Machine',
			'code' => 'CM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Punching Machine',
			'unit' => 'Per Sampel/Jam',
			'price1' => 35000,
			'price3' => 50000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Rolling Press',
			'code' => 'RP',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Rolling Press',
			'unit' => 'Per Sampel/Jam',
			'price1' => 45000,
			'price3' => 60000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Coating Machine',
			'code' => 'CM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Coating Machine',
			'unit' => 'Per Sampel/Jam',
			'price1' => 65000,
			'price3' => 100000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Glove Box',
			'code' => 'GB',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Glove Box',
			'unit' => 'Per Sampel/Jam',
			'price1' => 200000,
			'price3' => 350000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Microwave',
			'code' => 'MW',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Microwave',
			'unit' => 'Per Sampel/Jam',
			'price1' => 10000,
			'price3' => 15000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'DO Meter Digital',
			'code' => 'DO-MD',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'DO Meter Digital',
			'unit' => 'Per Sampel/Jam',
			'price1' => 20000,
			'price3' => 25000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Tachometer',
			'code' => 'TCM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Tachometer',
			'unit' => 'Per Sampel/Jam',
			'price1' => 50000,
			'price3' => 55000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Bor Listrik Tangan',
			'code' => 'BLT',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Bor Listrik Tangan',
			'unit' => 'Per Sampel/Jam',
			'price1' => 20000,
			'price3' => 25000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Gerinda Tangan',
			'code' => 'MGT',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Gerinda Tangan',
			'unit' => 'Per Sampel/Jam',
			'price1' => 20000,
			'price3' => 25000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Bor Duduk',
			'code' => 'BD',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Bor Duduk',
			'unit' => 'Per Sampel/Jam',
			'price1' => 20000,
			'price3' => 25000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Tang Amper',
			'code' => 'TA',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Tang Amper',
			'unit' => 'Per Sampel/Jam',
			'price1' => 20000,
			'price3' => 25000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'AVO Meter',
			'code' => 'AM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'AVO Meter',
			'unit' => 'Per Sampel/Jam',
			'price1' => 20000,
			'price3' => 25000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Osiloscope',
			'code' => 'OS',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Osiloscope',
			'unit' => 'Per Sampel/Jam',
			'price1' => 70000,
			'price3' => 85000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Mesin Potong Besi',
			'code' => 'MPB',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Mesin Potong Besi',
			'unit' => 'Per Sampel/Jam',
			'price1' => 30000,
			'price3' => 35000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Tap',
			'code' => 'TAP',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Tap',
			'unit' => 'Per Sampel/Jam',
			'price1' => 15000,
			'price3' => 20000,
			'discount' => 0,
			'tools_id' => $i,
		]);
	}
}
