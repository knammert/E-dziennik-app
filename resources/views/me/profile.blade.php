@extends('layouts.master')

@section('contentPage')

<div class="card mb-3 mt-3 " >
    <div class="row g-0">
      <div class="col-md-8">
        <div class="card-body">
                <p class="card-text">Imie: {{$user->name}}</p>
                <p class="card-text">Nazwisko: {{$user->surname}}</p>
                <p class="card-text">Adres e-mail: {{$user->email}}</p>
                <p class="card-text">PESEL: {{$user->pesel}}</p>
                <p class="card-text">
                    <small class="btn btn-light">
                        <a href="{{route('me.edit')}}">Edytuj profil</a>
                    </small>
                </p>
        </div>
      </div>
    </div>
  </div>
@endsection
