@extends('layouts.master')

@section('contentPage')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Dodaj nowe zajęcia</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('adminPanel.activities.index') }}"> Powrót</a>
        </div>
    </div>
</div>


<form action="{{ route('adminPanel.activities.store') }}" method="POST">
    @csrf

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Klasa:</strong>
            <select type="text" name="class_name_id" id="class_name_id" class="form-control">
                @foreach ($class_names as $class_name)
                    <option value="{{$class_name->id}}">{{$class_name->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Przedmiot:</strong>
            <select type="text" name="subject_id" id="subject_id" class="form-control">
                @foreach ($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Nauczyciel:</strong>
            <select type="text" name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}} {{$user->surname}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 ">
            <button type="submit" class="btn btn-primary">Dodaj nowe zajęcia</button>
    </div>


</form>
@endsection
