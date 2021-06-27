@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-secondary">Go Back</a>
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Body') !!}
            {!! Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body', 'id' => 'summernote']) !!}
        
        </div>

        <div class="form-group">
            {!! Form::file('cover_image') !!}
        </div>

        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection