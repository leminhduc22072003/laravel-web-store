<?php

namespace App\Http\Controllers\Chart;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentChart extends Controller
{
    function chartStudent1 () {
        $data = [];
        $districts = \App\Models\District::orderBy('id')->withCount('student_nursery', 'student_primary', 'student_junior_high', 'student_high', 'student_primary_junior_high', 'student_junior_and_high', 'student_cec')->get();
        foreach ($districts as $k => $item) {
            $data['district'][$k] = $item->name;
            $data['nursery'][$k] = $item['student_nursery_count'];
            $data['primary'][$k] = $item['student_primary_count'];
            $data['junior_high'][$k] = $item['student_junior_high_count'];
            $data['high'][$k] = $item['student_high_count'];
            $data['primary_junior_high'][$k] = $item['student_primary_junior_high_count'];
            $data['junior_and_high'][$k] = $item['student_junior_and_high_count'];
            $data['cec'][$k] = $item['student_cec_count'];
        }
        return Response()->json($data);
    }

    function chartStudent2 () {
        $data = [];
        $data['nursery'] = [];
        $data['primary'] = [];
        $data['junior_high'] = [];
        $data['high'] = [];
        $data['primary_junior_high'] = [];
        $data['junior_and_high'] = [];
        $data['cec'] = [];
        for ($i = 1; $i <= 2; $i++){
            $student = Student::where('gender', '=', $i);
            array_push($data['nursery'], $student->where('type_school', 1)->count());
            array_push($data['primary'], $student->where('type_school', 2)->count());
            array_push($data['junior_high'], $student->where('type_school', 3)->count());
            array_push($data['high'], $student->where('type_school', 4)->count());
            array_push($data['primary_junior_high'], $student->where('type_school', 5)->count());
            array_push($data['junior_and_high'], $student->where('type_school', 6)->count());
            array_push($data['cec'], $student->where('type_school', 7)->count());
        }
        return Response()->json($data);
    }
}
