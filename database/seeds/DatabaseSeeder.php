<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        UsersTableSeeder::class,
        CategoryTableSeeder::class,
        VisualTableSeeder::class,
        Category_VisualTableSeeder::class,
        QuestionTableSeeder::class,
        StatusTableSeeder::class,
        ]);
    }
}
