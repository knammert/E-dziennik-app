@extends('layouts.master')

@section('contentPage')

{{-- <div class="card mb-3 mt-3 shadow-lg p-3 mb-5 bg-white rounded " >
    <div class="row g-0">
      <div class="col-md-8">
        <div class="card-body">
                <p class="card-text">Imie: {{$user->name}}</p>
                <p class="card-text">Nazwisko: {{$user->surname}}</p>
                <p class="card-text">Adres e-mail: {{$user->email}}</p>
                <p class="card-text">PESEL: {{$user->pesel}}</p>
                <p class="card-text">
                    <small class="btn btn-light">
                        <a href="{{route('me.edit',$user->id)}}">Edytuj profil</a>
                    </small>
                </p>
        </div>
      </div>
    </div>
  </div> --}}
    <div class="row shadow-lg p-3 mb-5">
      <div class="col-lg-4">
        <div class="card mb-4 h-100">
          <div class="card-body text-center">
            @if ($user->avatar)
                    <img src="{{asset('storage/'.$user->avatar)}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            @else
                <img class="user-avatar" src="https://st.depositphotos.com/2101611/3925/v/600/depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" class="rounded-circle img-fluid" style="width: 150px;" alt="...">
            @endif
        <h5 class="my-3">{{$user->name}} {{$user->surname}}</h5>
        @if ($user->role==1)
            <p class="text-muted mb-1">Klasa: {{$user->surname}}</p>
        @elseif ($user->role==2)
            <p class="text-muted mb-1">Stanowisko: Nauczyciel </p>
            <p class="text-muted mb-4">Opole I liceum ogólnokształcące</p>
        @elseif ($user->role==3)
            <p class="text-muted mb-1">Stanowisko: Administrator systemu </p>
            <p class="text-muted mb-4">Opole I liceum ogólnokształcące</p>
        @endif
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4 h-100">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Imię</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nazwisko</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->surname}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">PESEL</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->pesel}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">E-mail</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Konto utworzone</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$user->created_at}}</p>
                </div>
            </div>
            <hr>
            <a class="" href="{{route('me.edit',$user->id)}}">Edytuj profil</a>
          </div>

        </div>

    </div>
</div>

@endsection
