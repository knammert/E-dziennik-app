<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Class_name_subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeacherGradesService
{

    public function generateAvgGrades($currentActivity)
    {

        $avgGrades=DB::table(DB::raw('users u'))
        ->select('name','g.grade',DB::raw('IFNULL(SUM(g.grade * g.weight) / SUM(g.weight),NULL) as avg'))
        ->leftJoin(DB::raw('grades g'),function($join) use($currentActivity) {$join->on('u.id','=','g.user_id')
        ->where('g.class_name_subject_id','=', $currentActivity->id); })
        ->where('u.class_name_id','=',$currentActivity->class_name_id)
        ->groupBy('u.surname')
        ->paginate(10);

        return $avgGrades;
    }
    public function getCurrentActivity($type, $activeUser)
    {
        if ($type != 'default') {
            return $currentActivity = Class_name_subject::find($type);
        }
        else {
           $currentActivity = Class_name_subject::where('user_id',$activeUser)->first();
           if($currentActivity==null){
               return redirect()
                   ->route('me.index')->with('status', 'Brak dostępnych klas');
        }

        return $currentActivity;
        }
    }
}
