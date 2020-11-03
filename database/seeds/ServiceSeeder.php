<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
			'price1' => 270000,
			'price3' => 300000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Zeta Potensial',
			'code' => 'ZP',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Zeta Potensial',
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
			'price1' => 280000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'X-Ray Diffraction (XRD)',
			'code' => 'XRF',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'X-Ray Diffraction (XRD)',
			'price1' => 550000,
			'price3' => 600000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Photoluminescence (PL)',
			'code' => 'PL',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Photoluminescence (PL)',
			'price1' => 380000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Fourier-Transform Infrared Spectroscopy (mR)',
			'code' => 'mR',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Fourier-Transform Infrared Spectroscopy (mR)',
			'price1' => 160000,
			'price3' => 200000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Scanning Electron Microscope (SEM)',
			'code' => 'SEM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Scanning Electron Microscope (SEM)',
			'price1' => 550000,
			'price3' => 750000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Energy-Dispersive X-ray spectroscopy (EDX)',
			'code' => 'EDX',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Energy-Dispersive X-ray spectroscopy (EDX)',
			'price1' => 160000,
			'price3' => 200000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Transmission Electron Microscopy (TEM)',
			'code' => 'TEM',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Transmission Electron Microscopy (TEM)',
			'price1' => 1350000,
			'price3' => 1800000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Transmission Electron Microscopy +
Energy-Dispersive X-ray spectroscopy (TEM + EDX)',
			'code' => 'TEM-EDX',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Transmission Electron Microscopy +
Energy-Dispersive X-ray spectroscopy (TEM + EDX)',
			'price1' => 1450000,
			'price3' => 1950000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Ultraviolet-Visible Spectrophotometry (UV-VIS)',
			'code' => 'UV-VIS',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Ultraviolet-Visible Spectrophotometry (UV-VIS)',
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
			'service' => 'Preparasi Sampel untuk PSA, ZETA POTENTIAL , PL, TEM, UV-VIS',
			'price1' => 53000,
			'price3' => 55000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Preparasi Sampel untuk SEM',
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
			'price1' => 1300000,
			'price3' => 1500000,
			'discount' => 0,
			'tools_id' => $i,
		]);

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
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Beadsmill Besar',
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
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Jaw Crusher Besar',
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
			'price1' => 150000,
			'price3' => 200000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Drying Oven Kecil Biru',
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
			'price1' => 350000,
			'price3' => 500000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Wet Ball Mill',
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
			'price1' => 30000,
			'price3' => 35000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Ultrasonik Batang',
			'price1' => 35000,
			'price3' => 40000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Furnace MTI X1200 ',
			'code' => 'MTI-X1200',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Furnace MTI X1200',
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
			'price1' => 500000,
			'price3' => 750000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Spray Pyrolysis Low',
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
			'price1' => 30000,
			'price3' => 35000,
			'discount' => 0,
			'tools_id' => $i,
		]);
		DB::table('prices')->insert([
			'service' => 'Timbangan Analitik',
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
			'price1' => 75000,
			'price3' => 100000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Laminar Air Flow',
			'code' => 'LAF',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Laminar Air Flow',
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
			'price1' => 20000,
			'price3' => 25000,
			'discount' => 0,
			'tools_id' => $i,
		]);

		$i++;
		DB::table('tools')->insert([
			'name' => 'Mesin Gerinda Tangan',
			'code' => 'MGT',
			'descrip' => '',
			'sample' => '',
			'labs_id' => 1,
			'actives_id' => 1,
			'usages_id' => 2,
		]);
		DB::table('prices')->insert([
			'service' => 'Mesin Gerinda Tangan',
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
			'price1' => 15000,
			'price3' => 20000,
			'discount' => 0,
			'tools_id' => $i,
		]);
	}
}
