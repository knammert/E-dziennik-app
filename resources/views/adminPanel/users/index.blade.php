@extends('layouts.master')

@section('contentPage')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Użytkownicy</h2>
                </div>

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th>Nr</th>
                <th>Imie</th>
                <th>Nazwisko</th>
                <th>PESEL</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Klasa</th>
                <th >Akcja</th>
            </tr>
        </thead>
            <tbody class="">
                @foreach ($users as $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->pesel }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ( $user->role ==0)
                            Brak roli
                        @elseif ( $user->role ==1)
                            Uczeń
                        @elseif ( $user->role ==2)
                            Nauczyciel
                        @endif
                    </td>
                    <td>
                        @if (isset($user->class_name->name))
                            {{$user->class_name->name}}
                        @else
                        Brak przypisanej
                        @endif

                    </td>
                    <td>
                        <form action="{{ route('adminPanel.subjects.index',$user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Usuń użytkownika</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
        {!! $users->links() !!}
        </div>
    @endsection
