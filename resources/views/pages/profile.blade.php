@extends('layouts.app')

@section('content')
<br><br>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                @if ($user->profile_image)
                    <img src="/storage/profile_image/{{$user->profile_image}}" style="height: 43%; width: 43%" class="container-fluid">
                @else
                    <img src="/images/avatar2.png" style="height: 43%; width: 43%" class="container-fluid" >
                @endif
                <div>
                    <br>
                    <h2 class="ml-4" style="font-weight: 400">{{$user->name}}</h2>
                    <h6 class="ml-4" style="font-weight: 400">{{$user->email}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <h1 class="text-center">Posts</h1>
            <h2 class="text-center">{{ \App\Post::all()->count() }}</h2>
        </div>

        <div class="col-sm-4">
            <h1 class="text-center">Friends</h1>
            <h2 class="text-center">{{ $friends->count() }}</h2>
        </div>
    </div>
    <br><br>

    <div class="tabContainer">
        <div class="buttonContainer">
            <button onclick="showPanel(0, '#CED0D8' )" >Post</button>
            <button onclick="showPanel(1, '#CED0D8' )">Friends</button>
            <button onclick="showPanel(2, '#CED0D8' )">Profile details </button>
        </div>
        
        <div class="tabPanel">

            <div class="row">
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                            <div class="col-sm-6 mt-3">
                                <img height="60%" src="/storage/cover_images/{{$post->cover_image}}" class="container-fluid" alt="">  
                                <h6 style="font-weight: 450" class="ml-3">{{$post->title}}</h6>
                            </div>                   
                    @endforeach
                    {{-- {{$users->links()}} --}}
                @else
                    <p>No Users Found</p>
                @endif
            </div>

        </div>
        <div class="tabPanel">

            <div class="row">
                @if (count($friends_list) > 0)
                    @foreach ($friends_list as $friend_list)
                            <div class="col-sm-6 mt-3">
                                <img height="60%" src="/storage/profile_image/{{$friend_list->profile_image}}" class="container-fluid" alt="">  
                                <h6 style="font-weight: 450" class="ml-3">{{$friend_list->name}}</h6>
                            </div>                   
                    @endforeach
                    {{-- {{$friends_list->links()}} --}}
                @else
                    <p>No Users Found</p>
                @endif
            </div>

        </div>
        <div class="tabPanel">

            <br>
            {!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">

                    <div class="col-sm-5 offset-sm-1">
                        <div class="form-group">
                            {!! Form::label('title', 'Name') !!}
                            {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body', 'Password') !!}
                            {!! Form::textarea('password', $user->password, ['class' => 'form-control', 'placeholder' => 'Body', ]) !!}
                        
                        </div>
        
                        {{-- <div class="form-group">
                            {!! Form::file('cover_image') !!}
                        </div> --}}
        
                    </div>
    
                    <div class="col-sm-5">       

                        <div class="form-group ml-3">
                            {!! Form::label('Profile picture', 'Profile picture',) !!}
                        </div>
                        @if ($user->profile_image)
                            <img src="/storage/profile_image/{{$user->profile_image}}" class="container-fluid" alt="An Image"><br><br>
                        @else
                            <img src="/images/avatar2.png" style="height: 63%; width: 63%" class="container-fluid" >
                        @endif
                        

                        <div class="form-group ml-3">
                            {!! Form::file('profile_image') !!}
                        </div>
                    </div>

                </div>

                <div class="col-sm-8 offset-sm-2">
                    {!! Form::hidden('_method', 'PUT') !!}
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-block']) !!}
                </div>

            {!! Form::close() !!}<br><br>

        </div><br><br>
        
    </div>

@endsection