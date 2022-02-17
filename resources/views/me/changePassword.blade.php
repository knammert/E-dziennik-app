@extends('layouts.master')

@section('contentPage')


<div class="card mb-3 mt-3 shadow-lg p-3 mb-5 bg-white rounded" >
    <div class="alert alert-warning" role="alert">
        Uwaga zmiana danych łączy się z utratą dostępu do serwisu do czasu weryfikacji przez administratora
    </div>

    <div class="row g-0 ">
        <div class="col-md-8">
            <div class="card-body">
                <form action="{{ route('changePassword') }}" method="post" enctype="multipart/form-data">
                    <!-- X-XSRF-TOKEN -->
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="password">Stare hasło</label>
                        <input
                            type="password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            id="password"
                            name="current_password"
                            />
                        @error('current_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Nowe hasło</label>
                        <input
                            type="password"
                            class="form-control @error('new_password') is-invalid @enderror"
                            id="new_password"
                            name="new_password"
                           />
                        @error('new_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Powtórz nowe hasło</label>
                        <input
                            type="password"
                            class="form-control @error('new_confrim_password') is-invalid @enderror"
                            id="new_confrim_password"
                            name="new_confrim_password"
                            />
                        @error('new_confrim_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Zapisz dane</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
