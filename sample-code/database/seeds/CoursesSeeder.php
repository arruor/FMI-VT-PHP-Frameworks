<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    private $courses = [
        'Първи', 'Втори', 'Трети', 'Четвърти'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->courses as $course) {
            DB::table('courses')->insert([
                'name' => $course,
            ]);
        }

    }
}
