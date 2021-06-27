@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-secondary">Go Back</a>
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
                <div class="card">
                    <div class="row">
                        <img src="/storage/cover_images/{{$post->cover_image}}" class="container-fluid col-sm-2" alt="">
                        <div class="col-sm-8">
                            <h5 style="font-weight: 450" class="ml-1"><b>{{$post->title}}</b></h5>
                        </div>
                    </div>
                </div><br>
                <div class="col-sm-8">
                    
                </div>                   
        @endforeach
        {{-- {{$pendings->links()}} --}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection