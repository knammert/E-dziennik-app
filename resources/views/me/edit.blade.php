@extends('layouts.master')

@section('contentPage')


<div class="card mb-3 mt-3 shadow-lg p-3 mb-5 bg-white rounded " >
    <div class="alert alert-warning" role="alert">
        Uwaga zmiana danych łączy się z utratą dostępu do serwisu do czasu weryfikacji przez administratora
    </div>

    <div class="row g-0 ">
        <div class="col-md-8">
            <div class="card-body">
                <form action="{{ route('me.update',$user->id) }}" method="post" enctype="multipart/form-data">
                    <!-- X-XSRF-TOKEN -->
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Imie</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"/>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="surname">Nazwisko</label>
                        <input
                            type="text"
                            class="form-control @error('surname') is-invalid @enderror"
                            id="surname"
                            name="surname"
                            value="{{ old('surname', $user->surname) }}"/>
                        @error('surname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Adres email</label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                        >
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pesel">PESEL</label>
                        <input
                            type="text"
                            class="form-control @error('pesel') is-invalid @enderror"
                            id="pesel"
                            name="pesel"
                            value="{{ old('pesel', $user->pesel) }}"/>
                        @error('pesel')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Zapisz dane</button>
                    <a href="{{ route('me.index') }}" class="btn btn-secondary">Anuluj</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
