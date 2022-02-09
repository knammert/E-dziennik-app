@extends('layouts.master')

@section('contentPage')



        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Zajęcia</h2>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Dodaj nowe zajęcia
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Dodawanie nowych zajęć</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('adminPanel.activities.store') }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <strong>Klasa:</strong>
                                        <select type="text" name="class_name_id" id="class_name_id" class="form-control">
                                            @foreach ($class_names as $class_name)
                                                <option value="{{$class_name->id}}">{{$class_name->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong>Przedmiot:</strong>
                                        <select type="text" name="subject_id" id="subject_id" class="form-control">
                                            @foreach ($subjects as $subject)
                                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong>Nauczyciel:</strong>
                                        <select type="text" name="user_id" id="user_id" class="form-control">
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} {{$user->surname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                        <button type="submit" class="btn btn-primary">Dodaj nową klasę</button>
                                    </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <table  class="table table-bordered">
            <tr>
                <th>Nr</th>
                <th>Nazwa przedmiotu</th>
                <th>Klasa</th>
                <th>Przypisany nauczyciel</th>
                <th width="280px">Akcja</th>
            </tr>
            @foreach ($class_name_subjects as $class_name_subject)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $class_name_subject->class_name->name }}</td>
                <td>{{ $class_name_subject->subject->name }}</td>
                <td>{{ $class_name_subject->user->name }} {{ $class_name_subject->user->surname }}</td>
                <td>

                    <form action="{{ route('adminPanel.activities.destroy',$class_name_subject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń zajęcia</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
        {!! $class_name_subjects->links() !!}
        </div>
    @endsection
