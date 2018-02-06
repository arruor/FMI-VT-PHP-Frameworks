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
        $this->call(CoursesSeeder::class);
        $this->call(SpecialitiesSeeder::class);
        $this->call(SubjectsSeeder::class);
        $this->call(StudentsSeeder::class);
        $this->call(StudentsAssessmentsSeeder::class);
    }
}
