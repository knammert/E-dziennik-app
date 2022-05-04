@extends('layouts.master')

@section('contentPage')

        <div class="row">
            <div class="col-lg-12 ">
                <div class="float-left">
                    <h2>Oceny</h2>
                    <h5>
                        Klasa: {{$activity->class_name->name}}
                        Przedmiot: {{$activity->subject->name}}

                    </h5>
                </div>
                <div class="float-right row mb-2 mr-2">
                    <!-- Wyszukiwarka użytkowników -->
                    <form class="form-inline" action="{{ route('teacherPanel.grades.index') }}">
                        <div class="form-row">
                            {{-- <label class="my-1 mr-2" for="phrase">Szukaj użytkownika:</label>
                            <div class="col">
                                <input type="text" class="form-control" name="phrase" placeholder="" value="{{ $phrase ?? '' }}">
                            </div> --}}
                            @php
                                $type = $type ?? '';
                            @endphp
                            <div class="col-auto">
                                <select class='custom-select mr-sm-2' name="type" id="type">
                                    @foreach ($activities as $activitie)
                                        <option value="{{$activitie->id}}"> Klasa: {{$activitie->class_name->name}} -- Przedmiot: {{$activitie->subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary" type="sumbit">Wyszukaj</button>
                        </div>
                    </form>

                        <div class="form-row ml-2 ">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                Wystawianie ocen
                            </button>
                        </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <table class="table table-bordered shadow-lg p-3 mb-5 bg-white rounded">
            <tr>
                <th>Nr</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Oceny</th>
                <th>Średnia ocen</th>
                <th>Przewidywana ocena roczna</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>
                    @foreach ($user->grade as $obj)

                        @if ($obj->class_name_subject_id==$activity->id)
                            <span data-html="true"
                            data-toggle="tooltip"
                            data-placement="top"
                            data-toggle="modal"
                            title="Waga: {{ $obj->weight }} | Komentarz: {{ $obj->comment }} | Semestr: {{ $obj->semestr }} ">
                                <a
                                type="button"
                                data-toggle="modal"
                                data-target="#editGradeModal-{{$obj->id}}">
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
      {!! $users->withQueryString()->links() !!}
        </div>

        {{-- Modal oraz skrypty --}}

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
                        <form action="{{ route('teacherPanel.grades.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <strong>Zajęcia:</strong>
                                <select type="text" name="activity" id="activity" class="form-control">
                                    <option  selected value="0"> -- Wybierz zajęcia --</option>
                                    @foreach ($activities as $activitie)
                                        <option value="{{$activitie->id}}"> Klasa: {{$activitie->class_name->name}} -- Przedmiot: {{$activitie->subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <strong>Użytkownicy:</strong>
                                <select disabled class="form-control" id="user" name="user" ></select>
                            </div>

                            <div class="form-group">
                                <strong>Ocena:</strong>
                                <select type="text" name="grade" id="grade" class="form-control">
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

                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                            <button type="submit" class="btn btn-primary">Dodaj nową ocenę</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>

{{-- Modal edit grade --}}
@foreach ($users as $user)
    @foreach ($user->grade as $obj)
        @if ($obj->class_name_subject_id==$activity->id)
            <div class="modal fade" id="editGradeModal-{{$obj->id}}" tabindex="-1" role="dialog" aria-labelledby="editGradeModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editGradeModal">Edycja oceny</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body">

                                     <form action="{{ route('teacherPanel.grades.update',$obj->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                            <p>Imię: {{$user->name}}</p>
                                            <p>Nazwisko: {{$user->surname}}</p>
                                            <p>Data dodania: {{$obj->created_at}}</p>
                                            <p>Ostatnio modyfikowana: {{$obj->updated_at}}</p>

                                        <div class="form-group">
                                            <strong>Ocena:</strong>
                                            <select type="text" name="grade" id="grade" class="form-control">
                                                <option @if ($obj->grade =='1') selected @endif value="1">1</option>
                                                <option @if ($obj->grade =='1.5') selected @endif value="1.5">1+</option>
                                                <option @if ($obj->grade =='1.75') selected @endif value="1.75">2-</option>
                                                <option @if ($obj->grade =='2') selected @endif value="2">2</option>
                                                <option @if ($obj->grade =='2.5') selected @endif value="2.5">2+</option>
                                                <option @if ($obj->grade =='2.75') selected @endif value="2.75">3-</option>
                                                <option @if ($obj->grade =='3') selected @endif value="3">3</option>
                                                <option @if ($obj->grade =='3.5') selected @endif value="3.5">3+</option>
                                                <option @if ($obj->grade =='3.75') selected @endif value="3.75">4-</option>
                                                <option @if ($obj->grade =='4') selected @endif value="4">4</option>
                                                <option @if ($obj->grade =='4.5') selected @endif value="4.5">4+</option>
                                                <option @if ($obj->grade =='4.75') selected @endif value="4.75">5-</option>
                                                <option @if ($obj->grade =='5') selected @endif value="5">5</option>
                                                <option @if ($obj->grade =='5.5') selected @endif value="5.5">5+</option>
                                                <option @if ($obj->grade =='5.75') selected @endif value="5.75">6-</option>
                                                <option @if ($obj->grade =='6') selected @endif value="6">6</option>
                                                {{-- value="{{ old('name', $obj->grade) }}"> --}}
                                                @error('grade')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <strong>Waga:</strong>
                                            <select type="text" name="weight" id="weight" class="form-control">
                                                <option @if ($obj->weight =='1') selected @endif value="1">1</option>
                                                <option @if ($obj->weight =='1.5') selected @endif value="1.5">1.5</option>
                                                <option @if ($obj->weight =='1.75') selected @endif value="1.75">1.75</option>
                                                <option @if ($obj->weight =='2') selected @endif value="2">2</option>
                                                <option @if ($obj->weight =='2.5') selected @endif value="2.5">2.5</option>
                                                <option @if ($obj->weight =='2.75') selected @endif value="2.75">2.75</option>
                                                <option @if ($obj->weight =='3') selected @endif value="3">3</option>
                                                <option @if ($obj->weight =='3.5') selected @endif value="3.5">3.5</option>
                                                <option @if ($obj->weight =='3.75') selected @endif value="3.75">3.75</option>
                                                <option @if ($obj->weight =='4') selected @endif value="4">4</option>
                                                <option @if ($obj->weight =='4.5') selected @endif value="4.5">4.5</option>
                                                <option @if ($obj->weight =='4.75') selected @endif value="4.75">4.75</option>
                                                <option @if ($obj->weight =='5') selected @endif value="5">5</option>
                                                <option @if ($obj->weight =='5.5') selected @endif value="5.5">5.5</option>
                                                <option @if ($obj->weight =='5.75') selected @endif value="5.75">5.75</option>
                                                <option @if ($obj->weight =='6') selected @endif value="6">6</option>
                                                @error('weight')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <strong>Semestr:</strong>
                                            <select type="text" name="semestr" id="semestr" class="form-control">
                                                <option @if ($obj->semestr =='1') selected @endif value="1">1 semestr</option>
                                                <option @if ($obj->semestr =='2') selected @endif value="2">2 semestr</option>
                                                @error('semestr')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <strong>Komentarz:</strong>
                                            <input type="text" name="comment" id="comment" class="form-control"
                                                value="{{ old('comment', $obj->comment) }}"/>
                                            @error('comment')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                        <button type="submit" class="btn btn-primary">Aktualizuj</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endforeach

<!-- Skrypt wczytywania studentów-->
<script>

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.get('type')){
        const type = urlParams.get('type');
        document.getElementById('type').value = type;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#activity').on('change', function() {
            var activity_id = $(this).val();

           // console.log(activity_id);
            if(activity_id!=0) {
                document.getElementById('user').disabled = false;
                $.ajax({
                    url: '/changeStudentList/'+activity_id,
                    type: "GET",
                    // data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                            if(data){
                                $('#user').empty();
                                $('#user').focus;
                                $.each(data, function(key, value){
                                $('select[name="user"]').append('<option value="'+ value.id +'">' + value.name +' '+ value.surname+'</option>');
                            });
                        }
                        else{
                            alert('fail')
                        $('#user').empty();
                        }
                    }
                });
            }
            else{
            $('#user').empty();
            document.getElementById('user').disabled = true;
            }
        });
    });

    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
        })
</script>
@endsection
