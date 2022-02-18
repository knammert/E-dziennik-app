<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Models\Class_name_subject;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class TeacherGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //  Test bramek
        //Metoda 1
            // if (! Gate::allows('admin-level')) {
            //     abort(403);
            // }
        //Metoda 1
            // Gate::authorize('admin-level');

        $phrase = $request->get('phrase');
        $type = $request->get('type', 'default');

        $ActiceUser = Auth::user()->id;
        $activities = Class_name_subject::all()->where('user_id','==',$ActiceUser);



         if ($type != 'default') {
             $activity = Class_name_subject::find($type);
             $users = User::groupBy('surname')
             ->where('class_name_id', $activity->class_name_id)
             ->paginate(10);

            $avgGrades=DB::table(DB::raw('users u'))
            ->select('name','g.grade',DB::raw('IFNULL(SUM(g.grade * g.weight) / SUM(g.weight),NULL) as avg'))
            ->leftJoin(DB::raw('grades g'),function($join) use($activity) {$join->on('u.id','=','g.user_id')
            ->where('g.class_name_subject_id','=', $activity->id); })
            ->where('u.class_name_id','=',$activity->class_name_id)
            ->groupBy('u.surname')
            ->paginate(10);
         }
         else {
            $activity = Class_name_subject::where('user_id',$ActiceUser)->first();
            if($activity==null){return redirect()
                ->route('me.index')->with('status', 'Brak dostępnych klas'); }

            $users = User:: with('class_name')
            ->groupBy('surname')
            ->where('class_name_id', $activity->class_name_id)
            ->paginate(10);

            $avgGrades=DB::table(DB::raw('users u'))
            ->select('name','g.grade',DB::raw('IFNULL(SUM(g.grade * g.weight) / SUM(g.weight),NULL) as avg'))
            ->leftJoin(DB::raw('grades g'),function($join) use($activity) {$join->on('u.id','=','g.user_id')
            ->where('g.class_name_subject_id','=', $activity->id); })
            ->where('u.class_name_id','=',$activity->class_name_id)
            ->groupBy('u.surname')
            ->paginate(10);
         }
        return view('teacherPanel.grades.index',
        [
        'activities' => $activities,
        'users' => $users,
        'activity'=> $activity,
        'avgGrades'=>$avgGrades
        ])  ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPanel.grade.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradeRequest $request)
    {

        $grade = new Grade();

        $data = $request->validated();

        $grade->user_id = $data['user'] ;
        $grade->class_name_subject_id = $data['activity'] ;
        $grade->grade = $data['grade'] ;
        $grade->weight = $data['weight'] ;
        $grade->comment = $data['comment'] ;
        $grade->semestr = $data['semestr'] ;

       $grade->save();

        return redirect()
            ->route('teacherPanel.grades.index')
            ->with('status', 'Ocenę dodano pomyślnie');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade,Request $request)
    {

        $check = Class_name_subject::where('id',$request->activity_id)->first();

        $user = User::where('id',$request->user_id)->first();
        $grades = Grade::where('id_user',$request->user_id)
        ->where('class_name_subject_id',$request->activity_id);



        return view('teacherPanel.grades.edit',
        [
        'user' => $user,
        'grades'=> $grades
        ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {

        $data=$request->validate([
            'grade' => 'required',
            'weight' => 'required',
            'comment'=> 'required',
            'semestr'=> 'required'
        ]);

        $grade->grade = $data['grade'] ;
        $grade->weight = $data['weight'] ;
        $grade->comment = $data['comment'] ;
        $grade->semestr = $data['semestr'] ;
        $grade->save();

        return redirect()->route('teacherPanel.grades.index')
                         ->with('status', 'Ocenna została zedytoowana pomyślnie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }
    public function changeStudentList($activity_id){

        $class_id = Class_name_subject::find($activity_id)->class_name;

        $users = User::all()->where('class_name_id','==',$class_id->id)
;
         return response()->json($users);
    }



}


