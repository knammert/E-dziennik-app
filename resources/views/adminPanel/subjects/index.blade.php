@extends('layouts.master')

@section('contentPage')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Przedmioty</h2>
                </div>
                <div class="float-right">
                    {{-- <a class="btn btn-success" href="{{ route('adminPanel.subjects.create') }}"> Dodaj nowy przedmiot</a> --}}
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Dodaj nowy przedmiot
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Dodawanie nowego przedmiotu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('adminPanel.subjects.store') }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <strong>Nazwa przedmiotu:</strong>
                                    <input type="text" name="name" class="form-control @error('weekday') is-invalid @enderror">
                                </div>

                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                <button type="submit" class="btn btn-primary">Dodaj nowy przedmiot</button>
                            </form>
                    </div>
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
