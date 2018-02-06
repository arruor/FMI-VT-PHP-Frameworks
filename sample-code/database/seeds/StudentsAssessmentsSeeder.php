<?php

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;

class StudentsAssessmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();
        $subjects = Subject::all();

        foreach ($students as $student) {
            foreach ($subjects as $subject) {
                DB::table('students_assessments')->insert([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'assessment' => rand(2,6),
                    'workload_lectures' => rand(0, $subject->workload_lectures),
                    'workload_exercises' => rand(0, $subject->workload_exercises),
                ]);
            }
        }
    }
}
