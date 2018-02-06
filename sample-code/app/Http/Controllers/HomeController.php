<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $studentName = $request->get('studentName', null);
        $courseID = $request->get('courseID', null);
        $specID = $request->get('specialityID', null);

        $courses = DB::table('courses')->get();
        $specialities = DB::table('specialities')->get();
        $subjects = Subject::all();

        // Get current page
        $perPage = 10;
        $currentPage = $request->get('page', 1);

        $query = DB::table('students')
            ->join('courses', 'students.course_id', '=', 'courses.id')
            ->join(
                'specialities',
                'students.speciality_id',
                '=',
                'specialities.id'
            )
            ->join(
                'students_assessments',
                'students_assessments.student_id',
                '=',
                'students.id'
            )
            ->join(
                'subjects',
                'students_assessments.subject_id',
                '=',
                'subjects.id'
            )

            ->select(
                'students.*',
                'courses.name',
                'specialities.name_short',
                DB::raw('GROUP_CONCAT(students_assessments.workload_lectures ORDER BY subject_id ASC) AS lectures_s'),
                DB::raw('GROUP_CONCAT(students_assessments.workload_exercises ORDER BY subject_id ASC) AS exercises_s'),
                DB::raw('GROUP_CONCAT(students_assessments.assessment ORDER BY subject_id ASC) AS assessment'),
                DB::raw('GROUP_CONCAT(subjects.workload_lectures ORDER BY subject_id ASC) AS lectures_sb'),
                DB::raw('GROUP_CONCAT(subjects.workload_exercises ORDER BY subject_id ASC) AS exercises_sb'),
                DB::raw('SUM(students_assessments.workload_lectures) AS lectures_total_s'),
                DB::raw('SUM(students_assessments.workload_exercises) AS exercises_total_s'),
                DB::raw('SUM(subjects.workload_lectures) AS lectures_total_sb'),
                DB::raw('SUM(subjects.workload_exercises) AS exercises_total_sb'),
                DB::raw('AVG(students_assessments.assessment) AS avg_assessment')
            );

        if (!is_null($courseID)) {
            $query->where('course_id', $courseID);
        }

        if (!is_null($specID)) {
            $query->where('speciality_id', $specID);
        }

        if (!is_null($studentName)) {
            $fname = $lname = '';
            $names = explode(' ', $studentName);
            if (array_key_exists(0, $names)) {
                $fname = $names[0];
                array_shift($names);
            }

            if (!empty($names)) {
                $lname = implode(' ', $names);
            }

            $query->where('fname', 'like', $fname . '%');
            $query->where('lname', 'like', $lname . '%');
        }

        $students = $query->groupBy('students.id')
            ->orderBy('fname', 'asc')
            ->orderBy('lname', 'asc')
            ->paginate($perPage);

        if ($students->lastPage() < $currentPage)
        {
            return redirect()->route('home');
        }


        return view(
            'home',
                [
                    'courses' => $courses,
                    'specialities' => $specialities,
                    'students' => $students,
                    'subjects' => $subjects,
                    'startIndex' => $students->firstItem(),
                ]
        );
    }
}
