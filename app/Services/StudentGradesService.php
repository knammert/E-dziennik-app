<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentGradesService
{
    public function generateStudentGrades()
    {
        $activeUser = Auth::user()->id;
        $avgGrades=DB::table(DB::raw('class_name_subjects c'))
            ->select('c.id',DB::raw('IFNULL(SUM(g.grade * g.weight) / SUM(g.weight),NULL) as avg'))
            ->leftJoin(DB::raw('grades g'),function($join) use($activeUser) {
                $join->on('c.id','=','g.class_name_subject_id')
                ->where('g.user_id','=', $activeUser);
            })
            ->where('class_name_id','=', Auth::user()->class_name_id)
            ->groupBy('id')
            ->paginate(10);


        return $avgGrades;
    }
}
