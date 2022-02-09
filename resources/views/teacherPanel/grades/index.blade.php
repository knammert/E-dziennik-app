@extends('layouts.master')

@section('contentPage')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Oceny</h2>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Wystawianie ocen
                      </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Wystawianie ocen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <form action="{{ route('adminPanel.class_names.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <strong>Zajęcia:</strong>
                                        <select type="text" name="class_name_id" id="class_name_id" class="form-control">
                                            @foreach ($activities as $activitie)
                                                <option value="{{$activitie->id}}"> Klasa: {{$activitie->class_name->name}} -- Przedmiot: {{$activitie->subject->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <strong>Użytkownicy:</strong>
                                        <input type="text" name="name" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <strong>Ocena:</strong>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <strong>Waga:</strong>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <strong>Semestr:</strong>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <strong>Komentarz:</strong>
                                        <input type="text" name="name" class="form-control">
                                    </div>

                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                    <button type="submit" class="btn btn-primary">Dodaj nową klasę</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Nr</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Oceny</th>
                <th>Średnia ocen</th>
                <th width="280px">Akcja</th>
            </tr>
            {{-- @foreach ($subjects as $subject)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $subject->name }}</td>
                <td>
                    <form action="{{ route('adminPanel.subjects.destroy',$subject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń przedmiot</button>
                    </form>
                </td>
            </tr>
            @endforeach --}}
        </table>
        <div class="d-flex justify-content-center">
        {{-- {!! $subjects->links() !!} --}}
        </div>
    @endsection
