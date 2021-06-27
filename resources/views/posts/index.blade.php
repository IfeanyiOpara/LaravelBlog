@extends('layouts.app')

@section('content')
    <div class="row offset-sm-2 col-sm-11">
        <a href="/posts/create" class="col-sm-12">
            <i class="fa fa-2x fa-user offset-sm-1" style="color:rgb(76, 76, 76)">&nbsp;&nbsp; </i>
            <input type="text" placeholder="What is on your mind today?" class="col-sm-6 "/>
        </a>
    </div><br>
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
                                {{$posts->links()}}
                            @else
                                <p>No Posts Found</p>
                            @endif
                        </div>
       </div>

       <div class="col-sm-6">
                @if (count($posts) > 0)
                @foreach ($posts as $post)
                
                        {{-- <div class="card mb-2">
                            <div class="row">
                                <div class="col-md-4 col-sm-4" >
                                    <img height="200" src="/storage/cover_images/{{$post->cover_image}}" class="container-fluid" alt="">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                    <small>Written on {{$post->created_at}} by <i><b>{{$post->user->name}}</b></i></small>
                                </div>
                            </div>
                        </div> --}}

                        

                        <div class="card">
                            <div class=" row ">
                                <h3><a class="ml-4" href="/posts/{{$post->id}}" style="color: black">{{$post->user->name}}</a></h3>
                                <p class=" offset-sm-4 mt-2">{{$post->created_at}}</p>
                            </div>
                            <h5 style="font-weight: 450" class="ml-3">{{$post->title}}</h5>
                            <div class="">
                                <img src="/storage/cover_images/{{$post->cover_image}}" class="container-fluid" alt="">
                            </div>
                            <div class="row ml-3 mt-2">
                                <i class="fa fa-2x fa-thumbs-up mb-2" style="color:rgb(76, 76, 76)">&nbsp;&nbsp; </i>
                                <i class="fa fa-2x fa-comments mb-2 offset-sm-9" style="color:rgb(76, 76, 76)">&nbsp;&nbsp; </i>
                                <div class="card col-sm-11 ml-2">
                                    <div class="col-sm-12">
                                        {{-- @if (count($comments) > 0)
                                            @foreach ($comments as $comment)
                                                    <div class="row">
                                                        <img height="60%" src="/storage/profile_image/{{$comment->user_id}}" class="container-fluid" alt="">  
                                                        <h6 style="font-weight: 450" class="ml-3">{{$comment->comment}}</h6>
                                                        
                                                    </div>                   
                                            @endforeach
                                            {{$comments->links()}}
                                        @else
                                            <p>No comments</p>
                                        @endif
                                        <h5>This is a comment</h5> --}}
                                    </div>
                                </div>
                                {!! Form::open(['action' => 'PostsController@comment', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                    <div class="col-sm-12">
                                        <div class="row ">
                                            <div class="form-group col-sm-8">
                                                {!! Form::text('comment', '', ['class' => 'form-control col-sm-12', 'placeholder' => 'Enter a comment', 'id' => 'comment']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::textarea('post_id', $post->id, ['class' => 'form-control', 'placeholder' => 'Post ID', 'hidden']) !!}
                                            
                                            </div>
                                            {!! Form::submit('comment', ['class' => 'btn btn-primary btn-sm', 'id'=>'button']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                                {{-- <input type="text" placeholder="Enter a comment" class="col-sm-11 ml-2 comment"/> --}}
                            </div><br>


                        </div><br><br>
                    
                @endforeach
                {{$posts->links()}}
            @else
                <p>No Posts Found</p>
            @endif
       </div>

       <div class="col-sm-3">
        {!! Form::open(['action' => 'PagesController@search_user', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="col-sm-12">
                <div class="row ">
                    <div class="form-group col-sm-7">
                        {!! Form::text('name', '', ['class' => 'form-control col-sm-12', 'placeholder' => 'Search Users']) !!}
                    </div>
                    <div class="col-sm-5">
                        {!! Form::submit('search', ['class' => 'btn btn-outline-secondary btn-sm']) !!}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        {{-- <input type="text" placeholder="Search Users" class="col-sm-10 "/> --}}
        <h5 style="font-weight: 450" class="mt-4">People you might know</h5><br>
                    <div class="row">
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                @if ($auth_user === $user->id)
                                    @continue
                                @else
                                    <div class="col-sm-6 mt-3 mb-3 card">
                                        <img height="30%" src="/storage/profile_image/{{$user->profile_image}}" class="container-fluid" alt="">  
                                        <h6 style="font-weight: 450" class="ml-3">{{$user->name}}</h6>       
                                                @if (count($friends) > 0)
                                                    @foreach ($friends as $friend)
                                                        @if ($friend->status === 1)
                                                            @if ($user->id === $friend->requester)
                                                                <p>Already friends</p>
                                                            @endif
                                                            @continue
                                                        @elseif($friend->status === 2)
                                                            @if ($user->id === $friend->requester)
                                                                <button class="btn btn-primary btn-sm ml-3 "><a href="/add/{{Auth::user()->id}}/{{$user->id}}" class="add_friend">Add friend</a></button>    
                                                            @endif
                                                            @continue
                                                        @elseif(\App\User::find($auth_user)->has_pending_friend_request_sent_to($user->id) === 1)
                                                            
                                                                <p><b>request sent</b></p>   
                                                            
                                                            @continue
                                                        @else
                                                            @if ($user->id === $friend->requester)
                                                                <button class="btn btn-primary btn-sm ml-3 "><a href="/add/{{Auth::user()->id}}/{{$user->id}}" class="add_friend">Add friend</a></button>    
                                                            @endif
                                                            @continue                                                    
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <button class="btn btn-primary btn-sm ml-3 "><a href="/add/{{Auth::user()->id}}/{{$user->id}}" class="add_friend">Add friend</a></button>    
                                                @endif
                                                @if (\App\User::find($auth_user)->has_pending_friend_request_from($user->id) === 1 or \App\User::find($auth_user)->has_pending_friend_request_sent_to($user->id) === 0)
                                                <button class="btn btn-primary btn-sm ml-3 "><a href="/add/{{Auth::user()->id}}/{{$user->id}}" class="add_friend">Add friend</a></button>
                                                @endif
                                    </div><br><br>
                                @endif 
                            @endforeach
                            {{$users->links()}}
                        @else
                            <p>No Users Found</p>
                        @endif
                    </div>
        </div>
   </div>
@endsection