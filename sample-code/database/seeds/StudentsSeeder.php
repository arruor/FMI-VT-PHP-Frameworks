<?php

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Speciality;

class StudentsSeeder extends Seeder
{
    private $fnm = [
        'Петър',
        'Иван',
        'Димитър',
        'Георги',
        'Александър',
        'Атанас',
        'Стефан',
        'Васил',
        'Христо',
        'Тодор',
    ];

    private $fnf = [
        'Мария',
        'Иванка',
        'Атанаска',
        'София',
        'Анна',
        'Николина',
        'Йорданка',
        'Райна',
        'Ивелина',
        'Грета',
    ];

    private $lnm = [
        'Петров',
        'Иванов',
        'Димитров',
        'Георгиев',
        'Александров',
        'Атанасов',
        'Стефанов',
        'Василев',
        'Христов',
        'Тодоров',
    ];

    private $lnf = [
        'Петрова',
        'Иванова',
        'Димитрова',
        'Георгиева',
        'Александрова',
        'Атанасова',
        'Стефанова',
        'Василева',
        'Христова',
        'Тодорова',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for ($x = 1; $x <= 120; $x++) {
            $gender = rand(1,2);
            DB::table('students')->insert([
                'fname' => ($gender == 1) ? $this->fnm[rand(0,9)] : $this->fnf[rand(0,9)],
                'lname' => ($gender == 1) ? $this->lnm[rand(0,9)] : $this->lnf[rand(0,9)],
                'fnumber' => 20000 + $x,
                'email' => sprintf("student_%d@uni-vt.bg", $x),
                'course_id' => array_random(Course::all()->toArray())['id'],
                'speciality_id' => array_random(Speciality::all()->toArray())['id'],
                'education_form' => (rand(1,2) == 1) ? 'Р' : 'З',
            ]);
        }
    }
}
