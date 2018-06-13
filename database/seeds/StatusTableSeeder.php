<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
      DB::table('status')->insert([
        [
            'id' => 0,
            'name' => 'Disable',
        ], 
        [
            'id' => 1,
            'name' => 'Public',
        ], 
        [
            'id' => 2,
            'name' => 'Private',
        ]
    ]);
    }
}
