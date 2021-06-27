@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-outline-secondary">Go Back</a><br><br>

    <div class="row">
        <div class="col-sm-3">
            {!! Form::open(['action' => 'PagesController@search_post', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="col-sm-12">
                    <div class="row ">
                        <div class="form-group col-sm-7">
                            {!! Form::text('title', '', ['class' => 'form-control col-sm-12', 'placeholder' => 'Search Post']) !!}
                        </div>
                        <div class="col-sm-5">
                            {!! Form::submit('search', ['class' => 'btn btn-outline-secondary btn-sm']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <h5 style="font-weight: 450" class="mt-4">Popular Adverts</h5><br>
                        <div class="row">
                            @if (count($posts) > 0)
                                @foreach ($posts as $post)
                                        <div class="col-sm-6">
                                            <img height="60%" src="/storage/cover_images/{{$post->cover_image}}" class="container-fluid" alt="">  
                                            <h5 style="font-weight: 450" class="ml-3">{{$post->title}}</h5>
                                        </div>                   
                                @endforeach
                                
                            @else
                                <p>No Posts Found</p>
                            @endif
                        </div>
        </div>
        <div class="col-sm-6">
            <h1>{{$post1->title}}</h1>
            <img src="/storage/cover_images/{{$post1->cover_image}}" class="container-fluid" alt="An Image">
            <br>
            <br>
            <div>{!!$post1->body!!}</div>
            <small>Written on {{$post1->created_at}} by <i><b>{{$post1->user->name}}</b></i></small>
            <br>
            @if (!Auth::guest())
                @if (Auth::user()->id == $post1->user_id)
                    <a href="/posts/{{$post1->id}}/edit" class="btn btn-outline-secondary">Edit</a>
                    {!! Form::open(['action' => ['PostsController@destroy', $post1->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                    {!! Form::close() !!}
                @endif
            @endif
        </div>
    </div>
@endsection