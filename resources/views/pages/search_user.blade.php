@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-secondary">Go Back</a>
    <h1>Users</h1>
    @if (count($users) > 0)
        @foreach ($users as $user)
                <div class="card">
                    <div class="row">
                        <img src="/storage/profile_image/{{$user->profile_image}}" class="container-fluid col-sm-2" alt="">
                        <div class="col-sm-8">
                            <h5 style="font-weight: 450" class="ml-1"><b>{{$user->name}}</b></h5>
                        </div>
                    </div>
                </div><br>
                <div class="col-sm-8">
                    
                </div>                   
        @endforeach
        {{-- {{$pendings->links()}} --}}
    @else
        <p>No Users Found</p>
    @endif
@endsection