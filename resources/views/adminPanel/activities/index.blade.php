@extends('layouts.master')

@section('contentPage')



        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Zajęcia</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('adminPanel.activities.create') }}"> Dodaj nowe zajęcia</a>
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
