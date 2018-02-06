<?php

use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    private $subjects = [
        ['name' => 'Математика', 'workload_lectures' => 80, 'workload_exercises' => 120],
        ['name' => 'Информатика', 'workload_lectures' => 120, 'workload_exercises' => 150],
        ['name' => 'Физика', 'workload_lectures' => 60, 'workload_exercises' => 60],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->subjects as $subject) {
            DB::table('subjects')->insert([
                'name' => $subject['name'],
                'workload_lectures' => $subject['workload_lectures'],
                'workload_exercises' => $subject['workload_exercises'],
            ]);
        }
    }
}
