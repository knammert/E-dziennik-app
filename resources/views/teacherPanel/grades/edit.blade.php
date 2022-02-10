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
                <form action="{{ route('teacherPanel.grades.index') }}" method="post" enctype="multipart/form-data">
                    <!-- X-XSRF-TOKEN -->
                    @csrf
                    <div class="border-top pt-1">
                        <div class="form-group">
                            <label for="pesel">Ocena</label>
                            <input
                                type="text"
                                class="form-control @error('pesel') is-invalid @enderror"
                                id="pesel"
                                name="pesel"
                                value="{{ old('pesel', $user->pesel) }}"/>
                            @error('pesel')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror


                            <div class="form-group">
                                <strong>Ocena:</strong>
                                <select
                                    type="text"
                                    class="form-control @error('grade') is-invalid @enderror"
                                    id="grade"
                                    name="grade"
                                    <option value="1">1</option>
                                    <option value="1.5">1+</option>
                                    <option value="1.75">2-</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2+</option>
                                    <option value="2.75">3-</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3+</option>
                                    <option value="3.75">4-</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4+</option>
                                    <option value="4.75">5-</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5+</option>
                                    <option value="5.75">6-</option>
                                    <option value="6">6</option>
                            </select>
                            </div>


                        </div>
                        <div class="form-group">
                            <label for="pesel">Waga</label>
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
                    </div>





                    <div class="form-group">
                        <strong>Waga:</strong>
                        <select type="text" name="weight" id="weight" class="form-control">
                                <option value="1">1</option>
                                <option value="1.5">1.5</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2</option>
                                <option value="2.5">2.5</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3</option>
                                <option value="3.5">3.5</option>
                                <option value="3.75">3.75</option>
                                <option value="4">4</option>
                                <option value="4.5">4.5</option>
                                <option value="4.75">4.75</option>
                                <option value="5">5</option>
                                <option value="5.5">5.5</option>
                                <option value="5.75">5.75</option>
                                <option value="6">6</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <strong>Semestr:</strong>
                        <select type="text" name="semestr" id="semestr" class="form-control">
                            <option value="1">1 semestr</option>
                            <option value="2">2 semestr</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <strong>Komentarz:</strong>
                        <input type="text" name="comment" id="comment" class="form-control">
                    </div>




                    <button type="submit" class="btn btn-primary">Zapisz dane</button>
                    <a href="{{ route('me.profile') }}" class="btn btn-secondary">Anuluj</a>
                </form>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
