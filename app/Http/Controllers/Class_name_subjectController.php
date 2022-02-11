<?php

namespace App\Http\Controllers;

use App\Models\Class_name;
use App\Models\Class_name_subject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class Class_name_subjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_name_subjects = Class_name_subject::latest()->paginate(10);
        $class_names = Class_name::all();
        $subjects = Subject::all();
        $users = User::all()->where('role','==','2');


        return view('adminPanel.activities.index',
        [
        'class_name_subjects' => $class_name_subjects,
        'class_names' => $class_names,
        'subjects' => $subjects,
        'users' => $users
        ])  ->with('i', (request()->input('page', 1) - 1) * 5);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name_id' => 'required',
            'subject_id' => 'required',
            'user_id' => 'required'
        ]);

        Class_name_subject::create($request->all());

        return redirect()->route('adminPanel.activities.index')
            ->with('status', 'Pomyślnie utworzono nowe zajęcia');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Class_name_subject  $class_name_subject
     * @return \Illuminate\Http\Response
     */
    public function show(Class_name_subject $class_name_subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Class_name_subject  $class_name_subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Class_name_subject $class_name_subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Class_name_subject  $class_name_subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Class_name_subject $class_name_subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Class_name_subject  $class_name_subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($class_name_subject)
    {

        $class_name_subject = Class_name_subject::find($class_name_subject);

        $class_name_subject->delete();

        return redirect()->route('adminPanel.activities.index')
            ->with('status', 'Pomyślnie usunięto wybrany przedmiot.');
    }
}