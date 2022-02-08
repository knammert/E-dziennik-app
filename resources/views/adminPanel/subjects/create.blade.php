@extends('layouts.master')

@section('contentPage')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Dodaj nowy przedmiot</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('adminPanel.subjects.index') }}"> Powrót</a>
        </div>
    </div>
</div>


<form action="{{ route('adminPanel.subjects.store') }}" method="POST">
    @csrf

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Nazwa przedmiotu:</strong>
            <input type="text" name="name" class="form-control">
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 ">
            <button type="submit" class="btn btn-primary">Dodaj nowy przedmiot</button>
    </div>


</form>
@endsection
