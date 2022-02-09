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

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                                            @foreach ($activities as $activitie)
                                                <option value="{{$activitie->id}}"> Klasa: {{$activitie->class_name->name}} -- Przedmiot: {{$activitie->subject->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <strong>Użytkownicy:</strong>
                                        <select class="form-control" id="user" name="user" ></select>
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

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                $('#activity').on('change', function() {
                    var activity_id = $(this).val();
                   // console.log(activity_id);
                    if(activity_id) {
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
                    }
                });
            });
        </script>

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
