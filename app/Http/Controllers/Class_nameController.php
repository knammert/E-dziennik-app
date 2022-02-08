<?php

namespace App\Http\Controllers;

use App\Models\Class_name;
use Illuminate\Http\Request;

class Class_nameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_names = Class_name::latest()->paginate(10);

        return view('adminPanel.class_names.index',compact('class_names'))
             ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPanel.class_names.create');
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
            'name' => 'required',
        ]);

        Class_name::create($request->all());

        return redirect()->route('adminPanel.class_names.index')
            ->with('status', 'Pomyślnie utworzono nową klasę');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Class_name  $class_name
     * @return \Illuminate\Http\Response
     */
    public function show(Class_name $class_name)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Class_name  $class_name
     * @return \Illuminate\Http\Response
     */
    public function edit(Class_name $class_name)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Class_name  $class_name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Class_name $class_name)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Class_name  $class_name
     * @return \Illuminate\Http\Response
     */
    public function destroy(Class_name $class_name)
    {
        $class_name->delete();

        return redirect()->route('adminPanel.class_names.index')
            ->with('status', 'Pomyślnie usunięto wybraną klasę.');
    }
}
