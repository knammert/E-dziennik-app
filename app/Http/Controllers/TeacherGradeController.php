<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Models\Class_name_subject;
use App\Models\Grade;
use App\Models\User;
use App\Services\TeacherGradesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TeacherGradesService $teacherGradesService)
    {

        $type = $request->get('type', 'default');
        $this->authorize('viewAnyTeacher', [Grade::class,$type]);

        $activeUser = Auth::user()->id;
        $activities = Class_name_subject::all()->where('user_id','==',$activeUser);
        $currentActivity = $teacherGradesService->getCurrentActivity($type, $activeUser);

        $avgGrades = $teacherGradesService->generateAvgGrades($currentActivity);
        $users = User::groupBy('surname')
            ->where('class_name_id', $currentActivity->class_name_id)
            ->paginate(10);


        return view('teacherPanel.grades.index',
        [
        'activities' => $activities,
        'users' => $users,
        'activity'=> $currentActivity,
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
        $this->authorize('create', Grade::class);
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
        $this->authorize('update', $grade);

        // if ($request->user()->cannot('update', $grade)) {
        //     abort(403);
        // }

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


