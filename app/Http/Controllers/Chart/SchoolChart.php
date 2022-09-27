<?php

namespace App\Http\Controllers\Chart;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolChart extends Controller
{
    function chartSchool1 () {
        $data = [];
        $districts = \App\Models\District::orderBy('id')->withCount('school_nursery', 'school_primary', 'school_junior_high', 'school_high', 'school_primary_junior_high', 'school_junior_and_high', 'school_cec')->get();
        foreach ($districts as $k => $item) {
            $data['district'][$k] = $item->name;
            $data['nursery'][$k] = $item['school_nursery_count'];
            $data['primary'][$k] = $item['school_primary_count'];
            $data['junior_high'][$k] = $item['school_junior_high_count'];
            $data['high'][$k] = $item['school_high_count'];
            $data['primary_junior_high'][$k] = $item['school_primary_junior_high_count'];
            $data['junior_and_high'][$k] = $item['school_junior_and_high_count'];
            $data['cec'][$k] = $item['school_cec_count'];
        }
        return Response()->json($data);
    }

    function chartSchool2 () {
        $data = [];
        $data['year'] = [];
        $data['nursery'] = [];
        $data['primary'] = [];
        $data['junior_high'] = [];
        $data['high'] = [];
        $data['primary_junior_high'] = [];
        $data['junior_and_high'] = [];
        $data['cec'] = [];
        $now = Carbon::now();
        $year = $now->year;
        $ago = $year - 10;
        for ($i = $ago; $i <= $year; $i++) {
            array_push($data['year'], $i);
            array_push($data['nursery'], \App\Models\School::where('type_school', '=', 1)->where('year', '=', $i)->count());
            array_push($data['primary'], \App\Models\School::where('type_school', '=', 2)->where('year', '=', $i)->count());
            array_push($data['junior_high'], \App\Models\School::where('type_school', '=', 3)->where('year', '=', $i)->count());
            array_push($data['high'], \App\Models\School::where('type_school', '=', 4)->where('year', '=', $i)->count());
            array_push($data['primary_junior_high'], \App\Models\School::where('type_school', '=', 5)->where('year', '=', $i)->count());
            array_push($data['junior_and_high'], \App\Models\School::where('type_school', '=', 6)->where('year', '=', $i)->count());
            array_push($data['cec'], \App\Models\School::where('type_school', '=', 7)->where('year', '=', $i)->count());
        }

        return Response()->json($data);
    }
}
