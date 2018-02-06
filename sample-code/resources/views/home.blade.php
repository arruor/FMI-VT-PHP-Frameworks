@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding-left: 50px;">
    <div class="row">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="row col-6 text-center">
            <form action="" method="get">
            <fieldset>
                <legend>Търсене</legend>
                <label for="studentName">Име: </label>
                <input id="studentName" name="studentName" type="text"><br />
                <label for="courseID">Курс: </label>
                <select id="courseID" name="courseID">
                    <option value="">--- Изберете ---</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select><br />
                <label for="specialityID">Специалност: </label>
                <select id="specialityID" name="specialityID">
                    <option value="">--- Изберете ---</option>

                    @foreach ($specialities as $с)
                        <option value="{{ $с->id }}">
                            ({{ $с->name_short }}) {{ $с->name }}
                        </option>
                    @endforeach

                </select>&nbsp;&nbsp;
                <input type="submit" class="btn btn-primary" value="Търси">
            </fieldset>
            </form>
        </div>
        <br class="clearfix" />
        <div class="row col-12">
            {{ $students->links('vendor.pagination.custom') }}
            <table class="table table-stripped table-responsive table-bordered">
                <thead class="thead-light justify-content-center">
                    <tr>
                        <td rowspan="2"></td>
                        <td colspan="2" rowspan="2"></td>
                    </tr>
                    <tr class="justify-content-center">
                        @foreach($subjects as $subject)
                            <td colspan="3" class="text-center"> {{ $subject->name }} </td>
                        @endforeach
                        <td colspan="3" class="text-center">Общо</td>
                    </tr>
                    <tr>
                        <td>№</td>
                        <td>Име, Фамилия</td>
                        <td>Курс</td>
                        <td>Лекции</td>
                        <td>Упражнения</td>
                        <td>Оценка</td>
                        <td>Лекции</td>
                        <td>Упражнения</td>
                        <td>Оценка</td>
                        <td>Лекции</td>
                        <td>Упражнения</td>
                        <td>Оценка</td>
                        <td>Лекции</td>
                        <td>Упражнения</td>
                        <td>Успех</td>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($students))
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $startIndex }}</td>
                            <td>{{ $student->fname }} {{ $student->lname }} ({{ $student->fnumber }})</td>
                            <td>{{ $student->name }}, {{ $student->name_short }}, ({{ $student->education_form }})</td>
                            @foreach($subjects as $key => $subject)
                            @php

                                $lectures_s = explode(',', $student->lectures_s);
                                $lectures_sb = explode(',', $student->lectures_sb);
                                $exercises_s = explode(',', $student->exercises_s);
                                $exercises_sb = explode(',', $student->exercises_sb);
                                $assessment = explode(',', $student->assessment);

                            @endphp
                            <td><span class="text-danger">{{ $lectures_s[$key] }}</span> ({{ $lectures_sb[$key] }})</td>
                            <td><span class="text-danger">{{ $exercises_s[$key] }}</span> ({{ $exercises_sb[$key] }})</td>
                            <td>{{ showGrade($assessment[$key]) }}</td>

                            @endforeach
                            <td><span class="text-danger">{{ $student->lectures_total_s }}</span> ({{ $student->lectures_total_sb }})</td>
                            <td><span class="text-danger">{{ $student->exercises_total_s }}</span> ({{ $student->exercises_total_sb }})</td>
                            <td>{{ showGrade(number_format($student->avg_assessment, 2)) }}</td>

                        </tr>
                        @php($startIndex++)
                        @endforeach
                    @else
                        Няма намерени резултати!
                    @endif
                </tbody>
            </table>
            {{ $students->links('vendor.pagination.custom') }}
        </div>

    </div>
</div>
@endsection
