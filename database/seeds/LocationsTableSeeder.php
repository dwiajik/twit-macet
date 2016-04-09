<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'name' => 'Simpang Tugu Yogyakarta',
            'latitude' => -7.782985,
            'longitude' => 110.367042,
            'query' => 'tugu',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);
        
        DB::table('locations')->insert([
            'name' => 'Simpang Bandara Adi Sucipto',
            'latitude' => -7.783505,
            'longitude' => 110.438018,
            'query' => 'bandara',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);
        
        DB::table('locations')->insert([
            'name' => 'Simpang UIN',
            'latitude' => -7.783155,
            'longitude' => 110.395088,
            'query' => 'uin',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);
        
        DB::table('locations')->insert([
            'name' => 'Jalan Malioboro',
            'latitude' => -7.794005,
            'longitude' => 110.365653,
            'query' => 'malioboro',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);
        
        DB::table('locations')->insert([
            'name' => 'Simpang Gramedia',
            'latitude' => -7.783042,
            'longitude' => 110.374909,
            'query' => 'gramedia',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Seturan',
            'latitude' => -7.761762,
            'longitude' => 110.411997,
            'query' => 'seturan',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Demak Ijo',
            'latitude' => -7.777219,
            'longitude' => 110.331667,
            'query' => 'demak ijo',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Maguwoharjo',
            'latitude' => -7.783526,
            'longitude' => 110.429779,
            'query' => 'maguwo',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Kawasan Kleringan',
            'latitude' => -7.790188,
            'longitude' => 110.368674,
            'query' => 'kleringan',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Demangan',
            'latitude' => -7.783164,
            'longitude' => 110.387846,
            'query' => 'demangan',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Gamping',
            'latitude' => -7.800389,
            'longitude' => 110.325178,
            'query' => 'gamping',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Kentungan',
            'latitude' => -7.754865,
            'longitude' => 110.383305,
            'query' => 'kentungan',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Jati Kencana',
            'latitude' => -7.781711,
            'longitude' => 110.3527,
            'query' => 'jati kencana',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Prambanan',
            'latitude' => -7.75555,
            'longitude' => 110.489036,
            'query' => 'prambanan',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Jalan Yogyakarta-Solo',
            'latitude' => -7.767962,
            'longitude' => 110.470779,
            'query' => 'solo',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Borobudur Plaza',
            'latitude' => -7.778398,
            'longitude' => 110.360982,
            'query' => 'borobudur plaza',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Ketandan',
            'latitude' => -7.811968,
            'longitude' => 110.4091,
            'query' => 'ketandan',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Selokan Mataram',
            'latitude' => -7.761338,
            'longitude' => 110.361796,
            'query' => 'selokan mataram',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Janti',
            'latitude' => -7.783312,
            'longitude' => 110.410425,
            'query' => 'janti',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang MM UGM',
            'latitude' => -7.765839,
            'longitude' => 110.378525,
            'query' => 'mm ugm',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang SGM',
            'latitude' => -7.802181,
            'longitude' => 110.39521,
            'query' => 'sgm',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Monjali',
            'latitude' => -7.751235,
            'longitude' => 110.371152,
            'query' => 'monjali',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Bioskop Permata',
            'latitude' => -7.801588,
            'longitude' => 110.372942,
            'query' => 'permata',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Condong Catur',
            'latitude' => -7.758425,
            'longitude' => 110.395719,
            'query' => 'condong catur',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang KM 0',
            'latitude' => -7.801383,
            'longitude' => 110.364769,
            'query' => 'km 0',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Badran',
            'latitude' => -7.789407,
            'longitude' => 110.357481,
            'query' => 'badran',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Gondomanan',
            'latitude' => -7.801541,
            'longitude' => 110.369321,
            'query' => 'gondomanan',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Simpang Kids Fun',
            'latitude' => -7.827845,
            'longitude' => 110.442521,
            'query' => 'kids fun',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('locations')->insert([
            'name' => 'Jalan Gedong Kuning',
            'latitude' => -7.807613,
            'longitude' => 110.402162,
            'query' => 'gedong kuning',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);
    }
}
