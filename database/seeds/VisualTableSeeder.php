<?php

use Illuminate\Database\Seeder;

class VisualTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('visuals')->insert([
        [
            'name' => 'Bubble Sort',
            'path' => 'bubblesort',
        ],
    ]);
    }
}
