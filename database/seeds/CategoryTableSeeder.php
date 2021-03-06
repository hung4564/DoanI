<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        [
            'name' => 'Data Struct',
            'detail' => 'Cấu trúc dữ liệu',
        ],
        [
          'name' => 'Algorithm',
          'detail' => 'Thuật toán',
        ],
        [
          'name' => 'Sort',
          'detail' => 'Sắp xếp',
        ],
        [
          'name' => 'Array',
          'detail' => 'Mảng',
        ]
    ]);
    }
}
