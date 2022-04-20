<?php

namespace App\Http\Controllers;

use App\Models\Class_name_subject;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAnyStudent', Grade::class);

        $class_name_subjects = Class_name_subject::
        whereHas('class_name', function($query) {
            $query->where('id', '=', Auth::user()->class_name_id);
        })
        ->groupBy('id')
        ->paginate(10);

        $activeUser = Auth::user()->id;
        $activeClass = Auth::user()->class_name_id;



        $avgGrades=DB::table(DB::raw('class_name_subjects c'))
            ->select('c.id',DB::raw('IFNULL(SUM(g.grade * g.weight) / SUM(g.weight),NULL) as avg'))
            ->leftJoin(DB::raw('grades g'),function($join) use($activeUser) {
                $join->on('c.id','=','g.class_name_subject_id')
                ->where('g.user_id','=', $activeUser);
            })
            ->where('class_name_id','=', Auth::user()->class_name_id)
            ->groupBy('id')
            ->paginate(10);


        // $avgGrades=DB::table(DB::raw('users u'))
        //     ->select('name','g.grade',DB::raw('IFNULL(SUM(g.grade * g.weight) / SUM(g.weight),NULL) as avg'))
        //     ->leftJoin(DB::raw('grades g'),function($join) use($activity) {$join->on('u.id','=','g.user_id')
        //     ->where('g.class_name_subject_id','=', $activity->id); })
        //     ->where('u.class_name_id','=',$activity->class_name_id)
        //     ->groupBy('u.surname')
        //     ->paginate(5);


        return view('studentPanel.grades.index',
        [
            'class_name_subjects'=>$class_name_subjects,
            'avgGrades' =>$avgGrades
        ])  ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
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
}
