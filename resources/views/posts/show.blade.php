@extends('layouts.master')

@section('contentPage')
<div>

    <div class="container   mt-2">
        <div class="row d-flex justify-content-center">
            <div class='col-8 shadow-lg p-3 mb-5 bg-white rounded'>
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1 ">{{$post->title}}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Dodano {{$post->created_at}}</div>
                        <!-- Post categories-->
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{ URL::asset("uploads/{$post->image_path}")}}" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        {{$post->description}}
                    </section>
                </article>
                <a href="{{ route('dashboard.index') }}" >Powrót</a>
            </div>
        </div>
    </div>
</div>

@endsection
