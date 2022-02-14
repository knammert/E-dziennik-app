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
                            <span data-html="true"
                            data-toggle="tooltip"
                            data-placement="top"
                            data-toggle="modal"
                            title="Waga: {{ $obj->weight }} | Komentarz: {{ $obj->comment }} | Semestr: {{ $obj->semestr }} ">
                                <a
                                type="button"
                                data-toggle="modal"
                                data-target="#showGradeModal-{{$obj->id}}">
                                @php
                                    $grade = $obj->grade;
                                    $order = array(".5", "1.75", "2.75", "3.75", "4.75", "5.75");
                                    $replace = array("+", "2-", "3-", "4-", "5-", "6-" );
                                    $newGrade = str_replace($order, $replace, $grade);
                                @endphp
                                {{$newGrade}}
                                    @if( !$loop->last)
                                    ,
                                    @endif
                                </a>
                            </span>
                        @endif
                    @endforeach
                </td>
                <td>
                    @php
                        $avg =   round($avgGrades[$loop->index]->avg,2);
                    @endphp
                    @if ($avg!=0)
                    {{$avg}}
                    @endif
                </td>
                <td>
                    @php
                    $predictedGrade = $avgGrades[$loop->index]->avg;
                    if( $predictedGrade ==null){
                        $predictedGrade = 'Brak ocen';
                    }
                    else if($predictedGrade<1.75){
                        $predictedGrade = 'Niedostateczny';
                    }
                    else if($predictedGrade<2.75){
                        $predictedGrade = 'Dopuszczający ';
                    }
                    else if($predictedGrade<3.75){
                        $predictedGrade = 'Dostateczny ';
                    }
                    else if($predictedGrade<4.75){
                        $predictedGrade = 'Dobry ';
                    }
                    else if($predictedGrade<5.75){
                        $predictedGrade = 'Bardzo dobry';
                    }
                    else{
                        $predictedGrade = 'Celujący ';
                    }
                    @endphp
                         {{$predictedGrade}}
                </td>

            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
        {!! $class_name_subjects->links() !!}
        </div>
{{-- Modal --}}
 @foreach ($class_name_subjects as $class_name_subject)
    @foreach ($class_name_subject->grade as $obj)
        @if ($obj->class_name_subject_id==$class_name_subject->id && $obj->user_id == Auth::user()->id)
                <div class="modal fade" id="showGradeModal-{{$obj->id}}" tabindex="-1" role="dialog" aria-labelledby="showGradeModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="showGradeModal">Szczegóły oceny</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        @php
                                        $grade = $obj->grade;
                                        $order = array(".5", "1.75", "2.75", "3.75", "4.75", "5.75");
                                        $replace = array("+", "2-", "3-", "4-", "5-", "6-" );
                                        $newGrade = str_replace($order, $replace, $grade);
                                     @endphp
                                     <p>Przedmiot: {{$class_name_subject->subject->name}}</p>
                                     <p>Ocena: {{$newGrade}}</p>
                                     <p>Waga: {{$obj->weight}}</p>
                                     <p>Semestr: {{$obj->semestr}}</p>
                                     <p>Komentarz: {{$obj->comment}}</p>
                                     <p>Wystawione przez: {{$class_name_subject->user->name}} {{$class_name_subject->user->surname}}</p>
                                     <p>Data dodania: {{$obj->created_at}}</p>
                                     <p>Ostatnio modyfikowana: {{$obj->updated_at}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                   </div>
                                </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
<script>
                  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@endsection
