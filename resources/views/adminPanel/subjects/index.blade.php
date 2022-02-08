@extends('layouts.master')

@section('contentPage')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Przedmioty</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('adminPanel.subjects.create') }}"> Dodaj nowy przedmiot</a>
                </div>
            </div>
        </div>


        <table  class="table table-bordered">
            <tr>
                <th>Nr</th>
                <th>Nazwa przedmiotu</th>

                <th width="280px">Akcja</th>
            </tr>
            @foreach ($subjects as $subject)
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
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
        {!! $subjects->links() !!}
        </div>
    @endsection
