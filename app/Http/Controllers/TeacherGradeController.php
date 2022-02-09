<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Models\Class_name_subject;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TeacherGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $subjects = Grade::latest()->paginate(10);
        $user = Auth::user()->id;
        $activities = Class_name_subject::all()->where('user_id','==',$user);


        return view('teacherPanel.grades.index',
        [
        'activities' => $activities,
        ])  ->with('i', (request()->input('page', 1) - 1) * 5);;
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
    public function edit(Grade $grade)
    {
        //
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
        //
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

        $users = User::all()->where('class_name_id','==',$class_id->id);

         return response()->json($users);
    }
}
