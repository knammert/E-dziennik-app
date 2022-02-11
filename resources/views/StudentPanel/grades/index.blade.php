@extends('layouts.master')

@section('contentPage')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Moje oceny</h2>
                    <h5>{{Auth::user()->name}} {{Auth::user()->surname}}</h5>
                </div>
            </div>
        </div>


        <table  class="table table-bordered">
            <tr>
                <th>Przedmiot</th>
                <th>Nauczyciel</th>
                <th>Oceny cząstkowe</th>
                <th>Średnia</th>
                <th>Przewidywana ocena śródroczna</th>
            </tr>
            @foreach ($class_name_subjects as $class_name_subject)
            <tr>
                <td>{{ $class_name_subject->subject->name }}</td>
                <td>{{ $class_name_subject->user->name }} {{ $class_name_subject->user->surname }}</td>
                <td>
                    @foreach ($class_name_subject->grade as $obj)
                        @if ($obj->class_name_subject_id==$class_name_subject->id && $obj->user_id == Auth::user()->id)
                            {{$obj->grade}}
                        @endif
                    @endforeach
                </td>
                <td>Średnia</td>

                <td>Przewidywana ocena śródroczna</td>

            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
        {{-- {!! $subjects->links() !!} --}}
        </div>
    @endsection
