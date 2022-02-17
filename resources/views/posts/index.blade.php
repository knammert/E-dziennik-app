@extends('layouts.master')

@section('contentPage')

<div class="text-white rounded">


    <div class="jumbotron p-3 p-md-5 text-white rounded" style="background-color:#4e73df">
        <div class="col-md-12 px-0">
          <h1 class="display-4 font-italic">{{$posts[0]->title}}</h1>

          @php
              $shortDescp= substr($posts[0]->description,0,500);
          @endphp
            <p class="lead my-3">{{$shortDescp}}...</p>
          <p class="lead mb-0"><a href="{{ route('dashboard.show',$posts[0]->id) }}" class="text-white font-weight-bold">Czytaj dalej...</a></p>
        </div>
    </div>


    <div class="row mb-2">

        @foreach ($posts as  $post)
            @if (!$loop->first)
                <div class="col-md-6">
                    <div class="card flex-md-row mb-4 box-shadow h-md-300">
                        <div class="card-body d-flex flex-column align-items-start">

                            <h3 class="mb-0">
                            <a class="text-dark" href="{{ route('dashboard.show',$post->id) }}">{{$post->title}}</a>
                            </h3>
                            <div class="mb-1 text-muted">
                                @php
                                    $m_en = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
                                    $m_pol = array("Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień");
                                    $data = str_replace($m_en, $m_pol, $post->created_at->format('M d'));
                                @endphp
                            Dodano: {{$data }}
                            </div>
                            <div class="mb-1 text-muted">
                                @php
                                $shortDescp= substr($post->description,0,140);
                                @endphp
                                        {{$shortDescp}}...
                            </div>

                            <div class="text-dark">
                        </div>

                                <a href="{{ route('dashboard.show',$post->id) }}">Czytaj dalej...</a>

                            {{-- <a href="{{route('me.edit',$user->id)}}">Edytuj profil</a> --}}
                        </div>
                        <img class="card-img-right flex-auto d-none d-md-block"  alt="Brak zdjęcia" style="width: 300px; height: 250px; object-fit: cover;"
                            src="{{ URL::asset("uploads/{$post->image_path}")}}" data-holder-rendered="true">
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div>


</div>

@endsection

