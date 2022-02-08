@extends('layouts.master')

@section('contentPage')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Klasy</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('adminPanel.class_names.create') }}"> Dodaj nową klasę</a>
                </div>
            </div>
        </div>


        <table  class="table table-bordered">
            <tr>
                <th>Nr</th>
                <th>Nazwa klasy</th>

                <th width="280px">Akcja</th>
            </tr>
            @foreach ($class_names as $class_name)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $class_name->name }}</td>
                <td>
                    <form action="{{ route('adminPanel.class_names.destroy',$class_name->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń klasę</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
        {!! $class_names->links() !!}
        </div>
    @endsection
