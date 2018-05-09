<?php

use Illuminate\Database\Seeder;

class Category_VisualTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_visual')->insert([
            [
                'visual_id' => '1',
                'category_id' => '1',
            ],
            [
                'visual_id' => '1',
                'category_id' => '3',
            ],
            [
                'visual_id' => '1',
                'category_id' => '4',
            ],
        ]);
    }
}
